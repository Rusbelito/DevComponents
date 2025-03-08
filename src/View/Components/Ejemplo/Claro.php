<?php

namespace Rusbelito\DevComponents\View\Components\Ejemplo;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Claro extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sisas = 5 ;

        return view('rusbelito::components.alert', compact('sisas'));
    }
}

