<?php

namespace Rusbelito\DevComponents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class DevComponentsServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios del aquete.
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
    public function boot() : void
    {

        // Cargar vistas desde el directorio de tu paquete
        $this->loadViewsFrom(__DIR__.'/resources/views/components', 'rusbelito');

        // Publicar vistas para que puedan ser sobrescritas en el proyecto
        $this->publishes([
            __DIR__.'/resources/views/components' => resource_path('views/components'),
        ]);

        // Registrar el componente Blade para usar la sintaxis <rusbelito:componente />
        Blade::componentNamespace('Rusbelito\\DevComponents\\Views\\Components', 'rusbelito');

    }
}


