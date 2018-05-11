<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ab838e92f87ca97e67ab6168d6c1a8f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ab838e92f87ca97e67ab6168d6c1a8f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ab838e92f87ca97e67ab6168d6c1a8f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
