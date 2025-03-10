<?php

namespace Conversion\Providers;

Use Vesper\Conversion\Converter;
Use Vesper\Conversion\Parser;
Use Vesper\Conversion\Registry;
Use Vesper\Conversion\RegistryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ConversionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Converter::class, function () {
            return new Converter();
        });

        $this->app->singleton(Parser::class, function (Application $app) {
            $registry = $app->make(Registry::class);

            return new Parser($registry);
        });

        $this->app->singleton(Registry::class, function () {
            $registry = new Registry();

            RegistryBuilder::build($registry);

            return $registry;
        });
    }
}