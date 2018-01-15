<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d5e9651f96c5d0d077921ca4de63472
{
    public static $files = array (
        '7d5e26177ec0c967a595fc634f0744a3' => __DIR__ . '/..' . '/bliskapaczkapl/bliskapaczka-api-client/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'B' => 
        array (
            'Bliskapaczka\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Bliskapaczka\\' => 
        array (
            0 => __DIR__ . '/..' . '/bliskapaczkapl/bliskapaczka-api-client/src/Bliskapaczka',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d5e9651f96c5d0d077921ca4de63472::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d5e9651f96c5d0d077921ca4de63472::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
