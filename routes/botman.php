<?php

use App\Conversations\TestWebviewConversation;
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Middleware\ApiAi;
use Illuminate\Support\Facades\Log;

$botman = resolve('botman');
$dialogFlow = ApiAi::create(env('DIALOG_FLOW_API_TOKEN'))->listenForAction();

// Apply global "received" middleware
$botman->middleware->received($dialogFlow);

$botman->hears('input.welcome', function (BotMan $bot) {
    // The incoming message matched the "my_api_action" on Dialogflow
    // Retrieve Dialogflow information:
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $apiAction = $extras['apiAction'];
    $apiIntent = $extras['apiIntent'];
    Log::alert("This is my reply " . $apiReply);
    Log::info($extras);
//    $bot->startConversation(new \App\Conversations\AnotherConversation());
    $bot->startConversation(new TestWebviewConversation());
})->middleware($dialogFlow);

$botman->hears('Start conversation', BotManController::class.'@startConversation');
