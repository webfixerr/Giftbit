<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2e45f2496c1510abc13dff310552f4d0
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Varun\\Giftbit\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Varun\\Giftbit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2e45f2496c1510abc13dff310552f4d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2e45f2496c1510abc13dff310552f4d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2e45f2496c1510abc13dff310552f4d0::$classMap;

        }, null, ClassLoader::class);
    }
}