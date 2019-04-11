<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cfcc2985893d6e5c1499993620aacf9
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Ontario\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ontario\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Ontario' => __DIR__ . '/../..' . '/includes/class-ontario.php',
        'Ontario\\ACF' => __DIR__ . '/../..' . '/includes/class-acf.php',
        'Ontario\\Capabilities' => __DIR__ . '/../..' . '/includes/class-capabilities.php',
        'Ontario\\Emails' => __DIR__ . '/../..' . '/includes/class-emails.php',
        'Ontario\\Frontend' => __DIR__ . '/../..' . '/includes/class-frontend.php',
        'Ontario\\Post_Types' => __DIR__ . '/../..' . '/includes/class-post-types.php',
        'Ontario\\Shortcodes' => __DIR__ . '/../..' . '/includes/class-shortcodes.php',
        'Ontario\\Subscription' => __DIR__ . '/../..' . '/includes/class-subscription.php',
        'Ontario\\Theme_Setup' => __DIR__ . '/../..' . '/includes/class-theme-setup.php',
        'Ontario\\Traits\\Ajax' => __DIR__ . '/../..' . '/includes/traits/class-ajax.php',
        'Ontario\\Traits\\Hooker' => __DIR__ . '/../..' . '/includes/traits/class-hooker.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cfcc2985893d6e5c1499993620aacf9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cfcc2985893d6e5c1499993620aacf9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9cfcc2985893d6e5c1499993620aacf9::$classMap;

        }, null, ClassLoader::class);
    }
}
