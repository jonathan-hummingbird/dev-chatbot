<?php

namespace App\Conversations;

use Illuminate\Support\Facades\Log;
use BotMan\BotMan\Messages\Conversations\Conversation;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class AnotherConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    private $conversationId = "5d9d1cef86d4eb2f8f270cfb";

    protected function getMessage()
    {
        if ($this->conversationId === null) {
            throw new InvalidArgumentException('Conversation ID is required');
        }
        $userId = env('BOT_SOCIETY_USER_ID');
        $apiKey = env('BOT_SOCIETY_API_KEY');
        $client = new Client([
            'base_uri' => 'https://app.botsociety.io/apisociety/1.1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'user_id' => $userId,
                'api_key_public' => $apiKey,
            ],
        ]);
        try {
            $response = $client->request("GET", "conversations/{$this->conversationId}", ['json' => []]);
            $response_decoded = json_decode($response->getBody()->getContents(), true);
            $messages = data_get($response_decoded, 'messages', []);
            return $messages;
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return "";
        }
    }

    public function run()
    {
        $messages = $this->getMessage();
        Log::info("ATTEMPT TO GET CONVERSATION");
        Log::info($messages);
        $this->say("Well done! You have entered another conversation.");
    }
}
