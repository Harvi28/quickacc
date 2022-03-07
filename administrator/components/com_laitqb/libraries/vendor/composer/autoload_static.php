<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita08be2185a74e7a6aedf9b285ee05146
{
    public static $prefixLengthsPsr4 = array (
        'Q' => 
        array (
            'QuickBooksOnline\\API\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'QuickBooksOnline\\API\\' => 
        array (
            0 => __DIR__ . '/..' . '/quickbooks/v3-php-sdk/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita08be2185a74e7a6aedf9b285ee05146::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita08be2185a74e7a6aedf9b285ee05146::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita08be2185a74e7a6aedf9b285ee05146::$classMap;

        }, null, ClassLoader::class);
    }
}
