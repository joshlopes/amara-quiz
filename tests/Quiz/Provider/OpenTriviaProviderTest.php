<?php

namespace LuisLopes\AmaraQuiz\Tests\Quiz\Provider;

use GuzzleHttp\Client;
use LuisLopes\AmaraQuiz\Quiz\Game;
use LuisLopes\AmaraQuiz\Quiz\Provider\OpenTriviaProvider;
use PHPUnit\Framework\TestCase;

class OpenTriviaProviderTest extends TestCase
{
    /**
     * @var OpenTriviaProvider
     */
    private $provider;

    protected function setUp()
    {
        parent::setUp();

        $this->provider = new OpenTriviaProvider(new Client());
    }

    public function testCreateGame()
    {
        $game = $this->provider->createGame();

        $this->assertInstanceOf(Game::class, $game);
        $this->assertCount(10, $game->getQuestions());
    }

}