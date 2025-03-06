@props(['model'=> null ,'key' => null ])

<tr @if ($model) wire:key="{{$key}}-{{ $model->id }}" @endif class="bg-white lg:hover:bg-cyan-50 flex flex-row flex-wrap mb-10 border lg:table-row lg:flex-no-wrap lg:border-b-4 lg:border-b-[#243441]">
    {{$slot}}
</tr>