<?php

namespace Rusbelito\DevComponents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Rusbelito\DevComponents\App\View\Components\Hola;

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

        // Lista de componentes del paquete
        $components = [
            'alert' => 'dev-components::components.alert',
            'hola' => Hola::class,
        ];

        // Registrar componentes del paquete
        foreach ($components as $alias => $view) {
            if (!view()->exists('components.' . $alias)) {
                Blade::component($view, $alias);
            }
        }

         $this->publishes([
            __DIR__.'/resources/views/components' => resource_path('views/vendor/dev-components/components'),
            __DIR__.'/resources/views' => resource_path('views'),
        ]);
    }
}
