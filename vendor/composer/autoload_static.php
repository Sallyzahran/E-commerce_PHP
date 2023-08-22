<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit19d42aa09d3a79d3ed20543a9890353f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit19d42aa09d3a79d3ed20543a9890353f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit19d42aa09d3a79d3ed20543a9890353f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit19d42aa09d3a79d3ed20543a9890353f::$classMap;

        }, null, ClassLoader::class);
    }
}
