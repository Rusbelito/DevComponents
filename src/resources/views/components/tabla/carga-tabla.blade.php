@props(['cantidad'])

<table class="border overflow-hidden rounded-lg w-full animate-pulse hidden" wire:loading.class.remove="hidden">
    <thead class="bg-gray-200">
        <tr>
            @for ($i = 0; $i < $cantidad; $i++)
                <x-tabla.carga-columna-head />
            @endfor
        </tr>
    </thead>

    <tbody>
        @for ($i = 0; $i < 3; $i++)
            <tr
                class="bg-white lg:hover:bg-cyan-50 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 border lg:border-b-4 lg:border-b-[#243441]">
                @for ($j = 0; $j < $cantidad; $j++)
                    <x-tabla.carga-columna-body />
                @endfor
            </tr>
        @endfor
    </tbody>
</table>
