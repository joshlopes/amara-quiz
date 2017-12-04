<?php

namespace LuisLopes\AmaraQuiz\Quiz\Provider;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use LuisLopes\AmaraQuiz\Quiz\Game;
use LuisLopes\AmaraQuiz\Quiz\Option;
use LuisLopes\AmaraQuiz\Quiz\Question;

class OpenTriviaProvider implements QuizProviderInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function createGame($numberQuestions = 10): Game
    {
        $request = new Request('GET', 'https://opentdb.com/api.php?amount=' . $numberQuestions);
        $response = $this->client->send($request);
        $questions = json_decode($response->getBody(), true);

        $game = new Game();
        foreach ($questions['results'] as $question) {
            $options = [];
            $options[] = new Option($question['correct_answer'], true);
            foreach ($question['incorrect_answers'] as $incorrectAnswer) {
                $options[] = new Option($incorrectAnswer, false);
            }
            shuffle($options);
            $game->addQuestion(new Question($question['question'], $options));
        }

        return $game;
    }
}
