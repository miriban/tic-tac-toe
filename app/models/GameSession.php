<?php
/**
 * Tic-Tac-Toe Game
 *
 * @package app
 * @author Mohammed Abuiriban
 *
 */
namespace app\models;

/**
 * Class GameSession
 * @package app\models
 */
class GameSession
{
    /**
     * Session keys to access a serialized object of tic tac toe game and the player of the game
     */
    const KEY_GAME = "GAME";
    const KEY_PLAYER = "PLAYER";

    /**
     * Constructor.
     *
     * start the php session
     *
     * @return void
     */
    public function __construct()
    {
        session_start();
    }

    // --------------------------------------------------------------------

    /**
     * check if the session is already initiated and has both the game and player keys
     *
     * @return bool
     */
    public function isGameInitiated()
    {
        if(isset($_SESSION[self::KEY_GAME]) && isset($_SESSION[self::KEY_PLAYER]))
            return TRUE;
        return FALSE;
    }

    /**
     * unserialize the tic tac toe game from the session using the game key to continue
     * with the last state of the game
     *
     * @return TicTacToe
     */
    public function getGame()
    {
        return unserialize($_SESSION[self::KEY_GAME]);
    }

    /**
     * get the player (X or O) from the session using the player key
     *
     * @return string
     */
    public function getPlayer()
    {
        return $_SESSION[self::KEY_PLAYER];
    }

    /**
     * serialize the tic tac toe and store it in the session with the game key
     *
     * @param TicTacToe $game
     * @return void
     */
    public function saveGame($game)
    {
        $_SESSION[self::KEY_GAME] = serialize($game);
    }

    /**
     * store the next player (X or O) in the session with the player key
     *
     * @param $player
     * @return void
     */
    public function savePlayer($player)
    {
        $_SESSION[self::KEY_PLAYER] = $player;
    }
}