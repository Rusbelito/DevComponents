<?php

namespace Rusbelito\DevComponents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class DevComponentsServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios del paquete.
     *
     * @return void
     */
    public function register()
    {
        // No es necesario registrar nada aquí para la publicación de vistas
    }

    /**
     * Realiza las acciones de "boot" necesarias para el paquete.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'dev-components');

        Blade::componentNamespace('App\\View\\Components', 'personalizado');

        $this->publishes([
            __DIR__ . '/resources/views/components' => resource_path('views/components'),
        ]);
    }
}
