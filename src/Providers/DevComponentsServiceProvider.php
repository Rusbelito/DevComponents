<?php

namespace Rusbelito\DevComponents\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;


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
 

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'rusbelito');

        $componentsPath = __DIR__ . '/../resources/views/components';

        $files = File::allFiles($componentsPath);

     
        // Lista de componentes del paquete
        $components = [
            'hola' => \Rusbelito\DevComponents\View\Components\Hola::class,
            'claro' => \Rusbelito\DevComponents\View\Components\Ejemplo\Claro::class,
        ];

        foreach ($files as $file) {
            
            if (str_ends_with($file->getFilename(), '.blade.php')) {
                $componentName = str_replace('/', '.', substr($file->getRelativePathname(), 0, -10));
                $viewPath = "rusbelito::components." . $componentName; // Ruta de la vista
                $components[$componentName] = $viewPath;
            }
        }

        foreach ($components as $alias => $view) {
            if (!view()->exists('components.' . $alias)) {
                Blade::component($view, $alias);
            }else{
                Blade::component('components.'.$alias,$alias);
            }
        }
 

        
        $compiler = new DevTagCompiler(
            app('blade.compiler')->getClassComponentAliases(),
            app('blade.compiler')->getClassComponentNamespaces(),
            app('blade.compiler')
        );
        
        
        // $compiler->renameAliases('dynamic-component','dynamic');
        
        
        
        app()->bind('rusbelito.compiler', fn() => $compiler);



        app('blade.compiler')->precompiler(function ($in) use ($compiler) {
            return $compiler->compile($in);
        });

        // dd(app('rusbelito.compiler')->getClassComponentAliases());
        
        $this->publishes([
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/rusbelito/components'),
            __DIR__ . '/../resources/views' => resource_path('views'),
        ],'laravel-assets');
    }
}
