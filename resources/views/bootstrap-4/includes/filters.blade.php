{{-- Sorry I use tailwindcss --}}
@if(isset($filters) && count($filters) > 0)
    <div class="relative text-left" x-data="{ isOpenFilters: false }" @click.away="isOpenFilters = false">
        <button type="button"
            x-on:click="isOpenFilters = !isOpenFilters"
            aria-label="{{ lang('operations.filter') }}"
            class="table-button ml-2 border border-yellow-300 bg-yellow-300 hover:bg-yellow-400 focus:bg-yellow-400 focus:border-yellow-200 focus:shadow-outline-yellow"
            id="table_filter_button"
            dusk="table-filter-button"
        >
            @svg('heroicon-s-filter', ['class' => 'mx-auto h-5 text-white'])
        </button>
        <button
            type="button"
            x-on:click="$wire.set('filterValues', []); $wire.set('search', ''); isOpenFilters = false"
            class="table-button ml-1 border border-red-400 bg-red-400 hover:bg-red-500 focus:bg-red-500 focus:border-red-300 focus:shadow-outline-red"
            dusk="reset-all-filters"
            id="reset-all-filters"
        >
            @svg('heroicon-s-x', ['class' => 'mx-auto h-5 text-white'])
        </button>
      {{-- Options --}}
        <div
            x-show="isOpenFilters"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="origin-top-left absolute left-0 w-64 z-50 bg-yellow-100 border-2 border-yellow-300 rounded-lg px-3 pb-3 pt-1 overflow-auto shadow-lg"
            dusk="table-filter-container"
            x-cloak
        >
            {{-- Add filters --}}
            @foreach($filters as $filter => $value)
                @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.filters.' . $value['filter'])
            @endforeach

            {{-- Buttons --}}
            <div class="flex justify-end">
                <button
                    type="button"
                    class="button flex mt-4 py-2 px-4 rounded-lg border border-yellow-300 bg-gray-50 hover:bg-gray-100 text-red-500 shadow cursor-pointer"
                    x-on:click="isOpenFilters = false"
                    dusk="table-filter-close-button"
                >
                    @svg('heroicon-s-x', ['class' => 'h-4 opacity-50 mr-1 mt-1 fill-current'])
                    {{-- Cerrar --}}
                    <span>{{ lang('operations.close') }}</span>
                </button>
                {{-- Add aditional buttons --}}
                @yield('filter-buttons')
            </div>
        </div>
    </div>
@endif
