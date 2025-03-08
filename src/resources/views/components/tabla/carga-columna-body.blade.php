<td class="w-full lg:w-auto py-3 px-12 text-center border lg:table-cell relative lg:static">
    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase w-1/5 h-6 "></span>

    <div class="my-5 w-full flex flex-col justify-center items-center">
        @for ($i = 0; $i < rand(1, 2); $i++)
            <div class=" rounded-sm bg-gray-200 h-5 w-full mt-1"></div>
        @endfor
    </div>
</td>