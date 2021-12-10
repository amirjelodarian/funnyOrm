<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit27f06f4ecd80050ff4ffd3f805e17987
{
    public static $files = array (
        'd0dca54c1bcbed938a539389e43e6364' => __DIR__ . '/../..' . '/App/helpers.php',
        '70bce1f3a67e13eabbc6b9058609e23b' => __DIR__ . '/../..' . '/Config/AllDataBasesConfig.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'App\\Models\\BaseModels\\BaseDatabase' => __DIR__ . '/../..' . '/App/Models/BaseModels/BaseDatabase.php',
        'App\\Models\\BaseModels\\Route' => __DIR__ . '/../..' . '/App/Models/BaseModels/Route.php',
        'App\\Models\\Product' => __DIR__ . '/../..' . '/App/Models/Product.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/App/Models/User.php',
        'App\\Models\\User2' => __DIR__ . '/../..' . '/App/Models/User2.php',
        'App\\Utilities\\Functions' => __DIR__ . '/../..' . '/App/Utilities/Functions.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Config\\Mysql\\MySqlDatabase' => __DIR__ . '/../..' . '/Config/Mysql/MySqlDatabase.php',
        'Config\\Sqlite\\SqliteDatabase' => __DIR__ . '/../..' . '/Config/Sqlite/SqliteDatabase.php',
        'UserController' => __DIR__ . '/../..' . '/App/Controller/UserController.php',
        'View' => __DIR__ . '/../..' . '/App/Models/BaseModels/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit27f06f4ecd80050ff4ffd3f805e17987::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit27f06f4ecd80050ff4ffd3f805e17987::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit27f06f4ecd80050ff4ffd3f805e17987::$classMap;

        }, null, ClassLoader::class);
    }
}
