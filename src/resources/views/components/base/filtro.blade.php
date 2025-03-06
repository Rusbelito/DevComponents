@props(['model', 'content'])

<div class="w-full flex items-center">

    @if ( $model && $model->hasPages()  || $content > 6)
        <div class="flex items-center lg:mr-3 text-white">
            <span class="hidden sm:block sm:ml-1">Mostrar</span>
            <select wire:model.live="content" class="mx-2 rounded-full bg-[#7C8690] border border-white">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            @if (auth()->user()->hasrole('Admin'))
                <span class="hidden lg:block">Entradas</span>
            @endif
        </div>
    @endif
    <x-input class="w-full" placeholder="Escribe Aqui Para Filtrar" wire:model.live="Buscar" type="search" />
</div>