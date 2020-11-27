<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80d44c1bc513afd0700d647c8226ff12
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hashids\\' => 8,
        ),
        'A' => 
        array (
            'Artme\\Paysera\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hashids\\' => 
        array (
            0 => __DIR__ . '/..' . '/hashids/hashids/src',
        ),
        'Artme\\Paysera\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80d44c1bc513afd0700d647c8226ff12::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80d44c1bc513afd0700d647c8226ff12::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
