<?php

namespace DevComponents;

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
        $this->loadViewsFrom(__DIR__ . '/resources/views/components', 'dev-componets');

        // Publicar vistas para que puedan ser sobrescritas en el proyecto
        $this->publishes([
            __DIR__ . '/resources/views/components' => resource_path('views/components'),
        ]);

        // Registrar el componente Blade sin el prefijo 'x-'
        $this->registerBladeComponents();
    }

    /**
     * Registra los componentes Blade.
     *
     * @return void
     */
    protected function registerBladeComponents(){
    // Obtener todos los archivos de vista de componentes
    $componentFiles = glob(__DIR__ . '/resources/views/components/*.blade.php');

    foreach ($componentFiles as $file) {
        // Extraer el nombre del componente sin la extensión `.blade.php`
        $componentName = basename($file, '.blade.php');

        // Registrar el componente dinámicamente
        Blade::component('dev-componets::components.' . $componentName, 'rusbelito:' . $componentName);
    }
}

}
