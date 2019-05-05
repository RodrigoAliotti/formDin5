<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit118e9c7d76b3c7fb4552d41e00c25517
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fpdf\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/fpdf/fpdf/src/Fpdf',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit118e9c7d76b3c7fb4552d41e00c25517::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit118e9c7d76b3c7fb4552d41e00c25517::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}