<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Frontend\\' => 5,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Frontend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/module/Frontend/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/module/Core/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a6d19669b3cd6a7e5969dee64b5fe58::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}