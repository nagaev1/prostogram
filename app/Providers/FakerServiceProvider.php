<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Swatty007\FakerImageGenerator\Providers\FakerImageGenerationProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (app()->bound('config')) {
            $locale ??= app('config')->get('app.faker_locale');
        }

        $locale ??= 'en_US';

        $abstract = Generator::class.':'.$locale;

        if (! app()->bound($abstract)) {
            $this->app->singleton(
                abstract: $abstract,
                concrete: function (): Generator {
                    $factory = Factory::create();
                    $factory->addProvider(new FakerImageGenerationProvider($factory));
                    return $factory;
                }
            );
        }
    }
}
