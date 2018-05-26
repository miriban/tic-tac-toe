<?php
/**
 * Tic-Tac-Toe Game
 *
 * @package app
 * @author Mohammed Abuiriban
 *
 */
namespace app;
use app\controllers\GameController;

/**
 * include models, controllers and vendors of the tic tac toe game
 */
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/utils/TwigLoader.php";
require_once __DIR__ . "/models/TicTacToe.php";
require_once __DIR__ . "/models/GameSession.php";
require_once __DIR__ . "/controllers/GameController.php";

/** @var  $gameController */
$gameController = new GameController();

/**
 * check if the request method is post or get and process them using game controller
 */
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $gameController->post();
}
else
{
    $gameController->get();
}