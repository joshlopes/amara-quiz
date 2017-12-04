<?php

namespace LuisLopes\AmaraQuiz\Quiz;

use LuisLopes\AmaraQuiz\Context;
use Twig_Environment;

class QuizHandler
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var QuizManager
     */
    private $quizManager;

    public function __construct(Twig_Environment $twig, QuizManager $quizManager)
    {
        $this->twig = $twig;
        $this->quizManager = $quizManager;
    }

    public function handle(array $event, Context $context): array
    {
        $logger = $context->getLogger();
        $logger->notice('Got event', $event);

        return [
            'statusCode' => 200,
            'headers' => [
                'Content-Type' => 'text/html',
            ],
            'body' => $this->twig->render('quiz/quiz.html.twig', ['game' => $this->quizManager->createGame()]),
        ];
    }

}
