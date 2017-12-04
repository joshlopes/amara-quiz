<?php

namespace LuisLopes\AmaraQuiz\Quiz;

use LuisLopes\AmaraQuiz\Bridge\Slack\SlackClient;
use LuisLopes\AmaraQuiz\Context;
use Twig_Environment;

class QuizCompleteHandler
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var SlackClient
     */
    private $slackClient;

    public function __construct(Twig_Environment $twig, SlackClient $slackClient)
    {
        $this->twig = $twig;
        $this->slackClient = $slackClient;
    }

    public function handle(array $event, Context $context): array
    {
        $logger = $context->getLogger();
        $logger->notice('Got event', $event);

        $queryParameters = $event['queryStringParameters'];
        $this->slackClient->sendMessage(sprintf(
            'Contestant "%s" scored "%d" in the quiz!',
            $queryParameters['username'],
            $queryParameters['score']
        ));

        return [
            'statusCode' => 200,
            'headers' => [
                'Content-Type' => 'text/html',
            ],
            'body' => $this->twig->render(
                'quiz/complete.html.twig',
                [
                    'username' => $queryParameters['username'],
                    'score' => $queryParameters['score'],
                ]
            ),
        ];
    }

}
