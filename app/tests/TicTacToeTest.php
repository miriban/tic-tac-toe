<?php

use PHPUnit\Framework\TestCase;
use app\models\TicTacToe;

class TicTacToeTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        require_once __DIR__ . "/../models/TicTacToe.php";
    }

    /**
     * @test
     */
    public function boardIsEmptyWhenInitiatedTest()
    {
        $game = new TicTacToe();
        $board = $game->getBoard();

        for($i=0; $i<3; $i++)
        {
            for($j=0; $j<3; $j++)
            {
                $this->assertEquals(TicTacToe::BLANK, $board[$i][$j]);
            }
        }
    }

    /**
     * @test
     */
    public function movePlayerTest()
    {
        $game = new TicTacToe();
        $players = array(TicTacToe::PLAYER_X, TicTacToe::PLAYER_O);

        for($i=0; $i<3; $i++)
        {
            for($j=0; $j<3; $j++)
            {
                $player = $players[rand(0, 1)];
                $game->move($i, $j, $player);
                $board = $game->getBoard();
                // test player move correctly
                $this->assertEquals($player, $board[$i][$j]);
            }
        }

        // test that the game is over after filling the 9 seats
        $this->assertEquals(TRUE, $game->isGameOver());

        // test reset empty all fields
        $game->reset();
        $board = $game->getBoard();

        for($i=0; $i<3; $i++)
        {
            for($j=0; $j<3; $j++)
            {
                $this->assertEquals(TicTacToe::BLANK, $board[$i][$j]);
            }
        }
    }

    /**
     * @test
     */
    public function checkWinnerTest()
    {
        $game = new TicTacToe();
        $players = array(TicTacToe::PLAYER_X, TicTacToe::PLAYER_O);
        $player = $players[rand(0, 1)];

        // check rows
        for($i=0; $i<3; $i++)
        {
            for($j=0; $j<3; $j++)
                $game->move($i, $j, $player);

            $game->check($player);
            $this->assertEquals($player, $game->getWinner());
            $this->assertEquals(TRUE, $game->isGameOver());
            $game->reset();
        }

        // check columns
        for($i=0; $i<3; $i++)
        {
            for($j=0; $j<3; $j++)
                $game->move($j, $i, $player);

            $game->check($player);
            $this->assertEquals($player, $game->getWinner());
            $this->assertEquals(TRUE, $game->isGameOver());
            $game->reset();
        }

        // check diagonals
        $game->move(0,0, $player);
        $game->move(1,1, $player);
        $game->move(2,2, $player);
        $game->check($player);
        $this->assertEquals($player, $game->getWinner());
        $this->assertEquals(TRUE, $game->isGameOver());
        $game->reset();

        $game->move(0,2, $player);
        $game->move(1,1, $player);
        $game->move(2,0, $player);
        $game->check($player);
        $this->assertEquals($player, $game->getWinner());
        $this->assertEquals(TRUE, $game->isGameOver());
        $game->reset();
    }
}