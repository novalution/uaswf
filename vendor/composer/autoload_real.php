<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit8f8ef1fa2f83c81ec59fdb84d3e7ee6d
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

        spl_autoload_register(array('ComposerAutoloaderInit8f8ef1fa2f83c81ec59fdb84d3e7ee6d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit8f8ef1fa2f83c81ec59fdb84d3e7ee6d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit8f8ef1fa2f83c81ec59fdb84d3e7ee6d::getInitializer($loader)();

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit8f8ef1fa2f83c81ec59fdb84d3e7ee6d::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire8f8ef1fa2f83c81ec59fdb84d3e7ee6d($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire8f8ef1fa2f83c81ec59fdb84d3e7ee6d($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
