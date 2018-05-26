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
 * Class TicTacToe
 * @package app\models
 */
class TicTacToe
{
    /**
     * List of all board states ( X, O, empty)
     *
     */
    const PLAYER_X = "X";
    const PLAYER_O = "O";
    const BLANK = "";

    /**
     * 3x3 array that acts like the tic tac board
     *
     * @var array
     */
    private $board;

    /**
     * a variable to keep track of number of moves performed by both users
     * if number of moves equal to 9 that's mean the board is full and the
     * game is over
     *
     * @var int
     */
    private $numberOfMoves = 0;

    /**
     * a variable that holds the winner of the game if exists otherwise it will be empty string
     *
     * @var string
     */
    private $winner = "";

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * Init the 3x3 board with the BLANK(empty) state.
     *
     * @return void
     */
    public function __construct()
    {
        for($i=0; $i<3; $i++)
        {
            $this->board[] = [self::BLANK, self::BLANK, self::BLANK];
        }
    }

    // --------------------------------------------------------------------

    /**
     * check if the value at the nth row and nth column of the board is empty
     *
     * @param int $row
     * @param int $column
     * @return bool
     */
    public function isCellEmpty($row, $column)
    {
        if($this->board[$row][$column] === self::BLANK)
            return TRUE;
        return FALSE;
    }

    /**
     * set the value of the nth row and nth column of the board to the passed player(X, O)
     *
     * @param int $row
     * @param int $column
     * @param string $player
     * @return void
     */
    public function move($row, $column, $player)
    {
        $this->board[$row][$column] = $player;
        $this->numberOfMoves++;
    }

    /**
     * check if the passed player wins the game and store it in the winner variable.
     *
     * @param $player
     * @return void
     */
    public function check($player)
    {
        if($this->checkRows() || $this->checkColumns() || $this->checkDiagonals())
        {
            $this->winner = $player;
        }
    }

    /**
     * check every row of the board if it has the same player return True
     *
     * @return bool
     */
    private function checkRows()
    {
        for($i=0; $i<3; $i++)
        {
            if($this->board[$i][0] !== self::BLANK &&
                $this->board[$i][0] === $this->board[$i][1] &&
                $this->board[$i][1] === $this->board[$i][2])
                return TRUE;
        }

        return FALSE;
    }

    /**
     * check every column of the board if it has the same player return True
     *
     * @return bool
     */
    private function checkColumns()
    {
        for($i=0; $i<3; $i++)
        {
            if($this->board[0][$i] !== self::BLANK &&
                $this->board[0][$i] === $this->board[1][$i] &&
                $this->board[1][$i] === $this->board[2][$i])
                return TRUE;
        }

        return FALSE;
    }

    /**
     * check the diagonals of the board if they have the same player then return True
     *
     * @return bool
     */
    private function checkDiagonals()
    {
        if($this->board[0][0] !== self::BLANK &&
            $this->board[0][0] === $this->board[1][1] &&
            $this->board[1][1] === $this->board[2][2])
            return TRUE;

        if($this->board[0][2] !== self::BLANK &&
            $this->board[0][2] === $this->board[1][1] &&
            $this->board[1][1] === $this->board[2][0])
            return TRUE;

        return FALSE;
    }

    /**
     * check if the number of moves is equal to 9 or if there is a winner then return True that
     * the game is over.
     *
     * @return bool
     */
    public function isGameOver()
    {
        if($this->numberOfMoves === 9 || $this->winner !== "")
        {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * get the winner of the game, empty string if there is no winner
     *
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * reinitialize all the cells of 3x3 board to be empty (blank)
     * set the winner to be empty string (no winner)
     * set the number of moves to 0
     *
     * @return void
     */
    public function reset()
    {
        $this->winner = "";
        $this->numberOfMoves = 0;

        for($i=0; $i<3; $i++)
        {
            $this->board[$i] = array(self::BLANK, self::BLANK, self::BLANK);
        }
    }

    /**
     * get the 3x3 board
     *
     * @return array
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * a simple string that visualize the 3x3 board
     *
     * @return string
     */
    public function __toString()
    {
        $board = "";

        for($i=0; $i<3; $i++)
        {
            $board .=  $this->board[$i][0] . " - ";
            $board .= $this->board[$i][1] . " - ";
            $board .=  $this->board[$i][2] . "<br>";
        }

        return $board;
    }
}