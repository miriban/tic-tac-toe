<?php
/**
 * Tic-Tac-Toe Game
 *
 * @package app
 * @author Mohammed Abuiriban
 *
 */
namespace app\controllers;

use app\models\TicTacToe;
use app\models\GameSession;
use app\utils\TwigLoader;
use app;

/**
 * Class GameController
 * @package app\controllers
 */
class GameController
{
    /** @var GameSession $session */
    private $session;

    /** @var TicTacToe $game */
    private $game;

    /** @var string $current_player*/
    private $current_player;

    /**
     * Constructor
     *
     * load the tic tac toe game
     *
     * @return void
     */
    public function __construct()
    {
        $this->loadGame();
    }

    // --------------------------------------------------------------------

    /**
     * load game either from session or create a new one if not existed
     *
     * @return void
     */
    private function loadGame()
    {
        $this->session = new GameSession();

        if(! $this->session->isGameInitiated())
        {
            $this->game = new TicTacToe();
            $this->current_player = TicTacToe::PLAYER_X;
        }
        else
        {
            $this->game = $this->session->getGame();
            $this->current_player = $this->session->getPlayer();
        }
    }

    /**
     * process get request and send html code as a response
     *
     * @param string $message
     * @return void
     */
    public function get($message = "")
    {
        try
        {
            $data['board'] = $this->game->getBoard();
            $data['message'] = $message;
            echo TwigLoader::getTwig()->render("ui.twig", $data);
        }
        catch (\Exception $exception)
        {
            echo "Twig template error " . $exception->getMessage();
        }
    }

    /**
     * process post request for reset game or for moving a player to a specific row and column in the board
     * then save the game and the player to the session
     *
     * @return void
     */
    public function post()
    {
        if(isset($_POST['reset']))
        {
            $this->game->reset();
        }

        if(! $this->game->isGameOver())
        {
            if(isset($_POST['row']) && isset($_POST['column']))
            {
                $player = $this->current_player;
                $row = $_POST['row'];
                $column = $_POST['column'];

                if($this->game->isCellEmpty($row, $column))
                {
                    $this->game->move($row, $column, $player);
                }

                $this->game->check($player);
            }

            $this->session->saveGame($this->game);
            $this->session->savePlayer($this->switchPlayer());
        }

        $this->get($this->getMessage());
    }

    /**
     * switch player from x to y and vise versa
     *
     * @return string
     */
    private function switchPlayer()
    {
        if($this->current_player === TicTacToe::PLAYER_X)
            return TicTacToe::PLAYER_O;
        return TicTacToe::PLAYER_X;
    }

    /**
     * return a message if a player wins the game or the game is over
     *
     * @return string
     */
    private function getMessage()
    {
        $winner = $this->game->getWinner();
        if($winner !== "")
        {
            return $winner . " wins!";
        }

        if($this->game->isGameOver())
        {
            return "game over!";
        }

        return "";
    }

}