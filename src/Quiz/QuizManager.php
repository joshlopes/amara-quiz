<?php

namespace LuisLopes\AmaraQuiz\Quiz;

use LuisLopes\AmaraQuiz\Quiz\Provider\QuizProviderInterface;

class QuizManager
{
    /**
     * @var QuizProviderInterface
     */
    private $quizProvider;

    public function __construct(QuizProviderInterface $quizProvider)
    {
        $this->quizProvider = $quizProvider;
    }

    public function createGame($numberQuestions = 10)
    {
        return $this->quizProvider->createGame($numberQuestions);
    }

}
