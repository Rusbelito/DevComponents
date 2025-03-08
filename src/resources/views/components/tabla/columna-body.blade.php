@props(['p' => 'p-3','name'])

<td class="w-full text-center {{$p}} text-gray-800 relative border block lg:table-cell lg:w-auto lg:static">
    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{$name}}</span>
    {{$slot}}
</td>