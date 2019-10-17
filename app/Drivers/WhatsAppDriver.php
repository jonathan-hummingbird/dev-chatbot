<?php

namespace App\Drivers;

use App\User;
use BotMan\BotMan\Drivers\HttpDriver;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;


class WhatsAppDriver extends HttpDriver
{
    protected $client;
    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest()
    {
        return ! is_null($this->event->get('user'));
    }

    /**
     * Retrieve the chat message(s).
     *
     * @return array
     */
    public function getMessages()
    {
        if (empty($this->messages)) {
            $message = $this->event->get('body');
            $userId = $this->event->get('to');
            $this->messages = [new IncomingMessage($message, $userId, $userId, $this->payload)];
        }
        return $this->messages;
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return !empty(env("TWILIO_ID")) && !empty(env("TWILIO_TOKEN"));
    }

    /**
     * Retrieve User information.
     * @param IncomingMessage $matchingMessage
     * @return User
     */
    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User(["", $matchingMessage->getSender(), ""]);
    }

    /**
     * @param IncomingMessage $message
     * @return \BotMan\BotMan\Messages\Incoming\Answer
     */
    public function getConversationAnswer(IncomingMessage $message)
    {
        // TODO: Implement getConversationAnswer() method.
    }

    /**
     * @param string|\BotMan\BotMan\Messages\Outgoing\Question $message
     * @param IncomingMessage $matchingMessage
     * @param array $additionalParameters
     * @return $this
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        // TODO: Implement buildServicePayload() method.
    }

    /**
     * @param mixed $payload
     * @return Response
     */
    public function sendPayload($payload)
    {
        // TODO: Implement sendPayload() method.
    }

    /**
     * @param Request $request
     * @return void
     */
    public function buildPayload(Request $request)
    {
        if (!$this->client) {
            try {
                $this->client = new Client(env("TWILIO_ID", ""), env("TWILIO_TOKEN", ""));
            } catch (ConfigurationException $e) {
                Log::error($e->getMessage());
            }
        }
        $this->payload = new ParameterBag((array) json_decode($request->getContent(), true));
        $this->event = Collection::make((array) $this->payload->get('entry')[0]);
        $this->content = $request->getContent();
    }

    /**
     * Low-level method to perform driver specific API requests.
     *
     * @param string $endpoint
     * @param array $parameters
     * @param \BotMan\BotMan\Messages\Incoming\IncomingMessage $matchingMessage
     * @return void
     */
    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
        // TODO: Implement sendRequest() method.
    }
}