<x-frontend-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('calendar.title') }}
                </h2>
            </div>
            @include('components.frontend-header-btns')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('calendar')
            </div>
        </div>
    </div>
</x-frontend-layout>
