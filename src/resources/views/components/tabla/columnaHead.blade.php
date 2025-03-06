@props(['name', 'sort', 'direccion', 'column', 'class', 'text' => true , 'orden'=> true])

<th class="flex {{ $class }} border cursor-default border-gray-400 font-bold uppercase text-gray-600 @if($orden) cursor-pointer hover:text-cyan-500 @endif hidden lg:table-cell"
    @if ($orden) wire:click="order('{{ $column }}')" @endif>
    {{ $name }}

    @if ($orden)
        @if ($sort == $column)
            <i class="fa fa-sort-{{ !$text ? 'numeric' : 'alpha' }}-{{ $direccion == 'asc' ? 'asc' : 'desc' }}"
                aria-hidden="true"></i>
        @else
            <i class="fa fa-sort float-right px-2 pt-1" aria-hidden="true"></i>
        @endif
        
    @endif
</th>