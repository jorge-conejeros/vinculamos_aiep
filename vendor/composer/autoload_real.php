<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit9a1a631228f9e9eb97e5fc983e1d7680
=======
class ComposerAutoloaderInitff59ae73464c77efaa6a38e4bc2478d3
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit9a1a631228f9e9eb97e5fc983e1d7680', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit9a1a631228f9e9eb97e5fc983e1d7680', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit9a1a631228f9e9eb97e5fc983e1d7680::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit9a1a631228f9e9eb97e5fc983e1d7680::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire9a1a631228f9e9eb97e5fc983e1d7680($fileIdentifier, $file);
=======
        spl_autoload_register(array('ComposerAutoloaderInitff59ae73464c77efaa6a38e4bc2478d3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitff59ae73464c77efaa6a38e4bc2478d3', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitff59ae73464c77efaa6a38e4bc2478d3::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInitff59ae73464c77efaa6a38e4bc2478d3::$files;
        $requireFile = \Closure::bind(static function ($fileIdentifier, $file) {
            if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
                $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

                require $file;
            }
        }, null, null);
        foreach ($filesToLoad as $fileIdentifier => $file) {
            $requireFile($fileIdentifier, $file);
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        }

        return $loader;
    }
}
<<<<<<< HEAD

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire9a1a631228f9e9eb97e5fc983e1d7680($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
=======
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
