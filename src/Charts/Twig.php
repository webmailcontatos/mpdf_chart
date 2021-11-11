<?php

namespace App\Charts;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Template engine twig
 */
class Twig
{
    /**
     * Twig
     * @var Environment
     */
    protected static $twig;

    /**
     * Render html templates
     * @param string $file   Html file
     * @param array  $params Params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function render(string $file, array $params = []): string
    {
        self::load();
        return self::$twig->render($file, $params);
    }

    /**
     * Load twig enviroment
     * @return void
     */
    protected static function load(): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $twig = new Environment($loader, [
                'cache' => '/tmp/',
            ]
        );
        $twig->setCache(false);
        self::$twig = $twig;
    }
}
