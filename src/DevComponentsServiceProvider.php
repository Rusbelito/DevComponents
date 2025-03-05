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
        // Cargar vistas desde el directorio de tu paquete
        $this->loadViewsFrom(__DIR__ . '/resources/views/components', 'dev-components');

        // Publicar vistas para que puedan ser sobrescritas en el proyecto
        $this->publishes([
            __DIR__ . '/resources/views/components' => resource_path('views/components'),
        ]);

        // Registrar los espacios de nombres de los componentes
        Blade::componentNamespace('dev-components', 'dev-components');
        Blade::componentNamespace('dev-components', 'nightshade');
        Blade::componentNamespace('dev-components', 'rusbelito');

        // Registrar el componente Blade sin el prefijo 'x-'
        $this->registerBladeComponents();
    }

    /**
     * Registra los componentes Blade.
     *
     * @return void
     */
    protected function registerBladeComponents()
    {
        // Obtener todos los archivos de vista de componentes
        $componentFiles = glob(__DIR__ . '/resources/views/components/*.blade.php');

        foreach ($componentFiles as $file) {
            // Extraer el nombre del componente sin la extensión `.blade.php`
            $componentName = basename($file, '.blade.php');

            // Registrar el componente dinámicamente bajo el prefijo de dev-components
            Blade::component('dev-components::' . $componentName, 'dev-components:' . $componentName);
            Blade::component('dev-components::' . $componentName, 'nightshade:' . $componentName);
            Blade::component('dev-components::' . $componentName, 'rusbelito:' . $componentName);
        }
    }
}

