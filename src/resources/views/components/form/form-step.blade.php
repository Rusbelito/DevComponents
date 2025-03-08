@props(['stepName', 'name', 'step', 'completo', 'error', 'last' => false])

<div @if ($stepName < $step) x-on:click="openTab = '{{ $stepName }}'" @endif
    class=" @if ($step > $stepName) cursor-pointer @else cursor-default @endif @if ($step == $stepName) flex @else hidden @endif items-center justify-center space-x-4 md:space-x-2 lg:space-x-4 md:flex">
    <span
        class="h-8 w-8 md:h-6 md:w-6 lg:h-8 lg:w-8 items-center justify-center rounded-full 
        @if ($step == $stepName) flex @else hidden @endif 
        @if ($error) text-white bg-rose-700 
        @elseif($stepName == $step) bg-cyan-600 text-white 
        @elseif($completo) bg-emerald-500 text-white 
        @else text-cyan-700 bg-white @endif 
        shadow md:inline-flex md:text-sm lg:text-base">

        @if ($error)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18M6 6l12 12" />
            </svg>
        @elseif($completo)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        @else
            {{ $stepName }}
        @endif

    </span>

    <span
        class=" md:inline font-semibold 
        @if ($step != $stepName) hidden @endif 
        @if ($error) text-rose-700 
        @elseif($stepName == $step) text-cyan-600 
        @elseif($completo) text-emerald-500 
        @else text-white @endif">
        {{ $name }}
    </span>

    @if (!$last)
        <span class="h-0 w-12 md:w-5 lg:w-10 border-t-2 hidden 
            @if ($error) border-rose-700 border-dashed
            @elseif($stepName == $step) border-cyan-600 border-dashed
            @elseif($completo) border-emerald-500 border-double
            @else border-gray-400 border-dashed @endif 
            md:inline ">
        </span>
    @endif
</div>
