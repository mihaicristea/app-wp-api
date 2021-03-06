<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pagination\\' => 11,
        ),
        'F' => 
        array (
            'Frontend\\' => 9,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pagination\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-pagination/php-pagination/src',
        ),
        'Frontend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/Frontend/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/Core/src',
        ),
    );

    public static $classMap = array (
        'Pagination\\Pagination' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/Pagination.php',
        'Pagination\\StrategyGoogle' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/StrategyGoogle.php',
        'Pagination\\StrategyJumping' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/StrategyJumping.php',
        'Pagination\\StrategyPHPBB' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/StrategyPHPBB.php',
        'Pagination\\StrategyPaginationInterface' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/StrategyPaginationInterface.php',
        'Pagination\\StrategySimple' => __DIR__ . '/..' . '/php-pagination/php-pagination/src/StrategySimple.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58::$classMap;

        }, null, ClassLoader::class);
    }
}
