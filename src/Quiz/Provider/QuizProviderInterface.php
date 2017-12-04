<?php

namespace LuisLopes\AmaraQuiz\Quiz\Provider;

use LuisLopes\AmaraQuiz\Quiz\Game;

interface QuizProviderInterface
{

    public function createGame($numberQuestions): Game;

}
