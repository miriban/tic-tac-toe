<?php
/**
 * Tic-Tac-Toe Game
 *
 * @package app
 * @author Mohammed Abuiriban
 *
 */
namespace app\utils;

/**
 * Class TwigLoader
 * @package app\utils
 */
class TwigLoader
{
    /** @var string $TEMPLATE_PATH */
    private static $TEMPLATE_PATH = __DIR__ . "/../views";

    /** @var string $TEMPLATE_CACHE_PATH */
    private static $TEMPLATE_CACHE_PATH =   __DIR__ . "/../views/cache";

    /**
     * load twig with paths and cache paths
     *
     * @return \Twig_Environment
     */
    public static function getTwig()
    {
        $loader = new \Twig_Loader_Filesystem(TwigLoader::$TEMPLATE_PATH);
        return new \Twig_Environment($loader, ['cache' => TwigLoader::$TEMPLATE_CACHE_PATH]);
    }
}