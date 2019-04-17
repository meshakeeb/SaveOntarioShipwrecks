<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cfcc2985893d6e5c1499993620aacf9
{
    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'dimadin\\WP\\Library\\Backdrop\\' => 28,
        ),
        'O' => 
        array (
            'Ontario\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'dimadin\\WP\\Library\\Backdrop\\' => 
        array (
            0 => __DIR__ . '/..' . '/dimadin/backdrop/inc',
        ),
        'Ontario\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Ontario' => __DIR__ . '/../..' . '/includes/class-ontario.php',
        'Ontario\\ACF' => __DIR__ . '/../..' . '/includes/class-acf.php',
        'Ontario\\Capabilities' => __DIR__ . '/../..' . '/includes/class-capabilities.php',
        'Ontario\\Email_Queue' => __DIR__ . '/../..' . '/includes/class-email-queue.php',
        'Ontario\\Emails' => __DIR__ . '/../..' . '/includes/class-emails.php',
        'Ontario\\Export_CSV' => __DIR__ . '/../..' . '/includes/class-export-csv.php',
        'Ontario\\Frontend' => __DIR__ . '/../..' . '/includes/class-frontend.php',
        'Ontario\\Post_Types' => __DIR__ . '/../..' . '/includes/class-post-types.php',
        'Ontario\\Shortcodes' => __DIR__ . '/../..' . '/includes/class-shortcodes.php',
        'Ontario\\Subscription' => __DIR__ . '/../..' . '/includes/class-subscription.php',
        'Ontario\\Theme_Setup' => __DIR__ . '/../..' . '/includes/class-theme-setup.php',
        'Ontario\\Traits\\Ajax' => __DIR__ . '/../..' . '/includes/traits/class-ajax.php',
        'Ontario\\Traits\\Hooker' => __DIR__ . '/../..' . '/includes/traits/class-hooker.php',
        'Temporary_Command' => __DIR__ . '/..' . '/dimadin/wp-temporary/cli/Temporary_Command.php',
        'WP_Temporary' => __DIR__ . '/..' . '/dimadin/wp-temporary/class-wp-temporary.php',
        'dimadin\\WP\\Library\\Backdrop\\Main' => __DIR__ . '/..' . '/dimadin/backdrop/inc/Main.php',
        'dimadin\\WP\\Library\\Backdrop\\Server' => __DIR__ . '/..' . '/dimadin/backdrop/inc/Server.php',
        'dimadin\\WP\\Library\\Backdrop\\Task' => __DIR__ . '/..' . '/dimadin/backdrop/inc/Task.php',
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
