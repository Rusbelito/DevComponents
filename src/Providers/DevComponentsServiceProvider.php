<?php

namespace Rusbelito\DevComponents\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Rusbelito\DevComponents\View\Components\Hola;

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



         $compiler = new DevTagCompiler(
             app('blade.compiler')->getClassComponentAliases(),
             app('blade.compiler')->getClassComponentNamespaces(),
             app('blade.compiler')
         );
         app()->bind('rusbelito.compiler', fn () => $compiler);


         app('blade.compiler')->precompiler(function ($in) use ($compiler) {
             return $compiler->compile($in);
         });


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'rusbelito');

        // Lista de componentes del paquete
        $components = [
            'alert' => 'rusbelito::components.tabla.carga-tabla',
            'hola' => Hola::class,
        ];

        // Registrar componentes del paquete
        foreach ($components as $alias => $view) {
            if (!view()->exists('components.' . $alias)) {
                Blade::component($view, $alias);
            }
        }

        


         $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/vendor/rusbelito/components'),
            __DIR__.'/../resources/views' => resource_path('views'),
        ]);
    }
}

