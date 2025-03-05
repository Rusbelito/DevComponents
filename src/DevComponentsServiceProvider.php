<?php

namespace Rusbelito\DevComponents;

use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // Publicar las vistas en el directorio adecuado de Laravel
        $this->publishes([
            __DIR__.'/Vistas' => resource_path('views/components'),
        ], 'vistas');
    }
}

