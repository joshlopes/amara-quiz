<?php

namespace LuisLopes\AmaraQuiz\Bridge\Slack;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;

class SlackClient
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $webhook;

    public function __construct(ClientInterface $client, string $webhook)
    {
        $this->client = $client;
        $this->webhook = $webhook;
    }

    public function sendMessage($message)
    {
        $message = ['fallback' => $message, 'text' => $message];
        $request = new Request(
            'POST',
            $this->webhook,
            ['Content-Type' => 'application/json'],
            json_encode($message)
        );
        $this->client->send($request);
    }

}
