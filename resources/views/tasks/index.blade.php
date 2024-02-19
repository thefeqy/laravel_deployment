<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                      <h2>Tasks</h2>
                      <a href="{{ route('tasks.create') }}"
                          class="md:block p-3 px-6 pt-2 text-white bg-black rounded-full baseline hover:bg-brightRedLight">{{ __('Create new task') }}</a>
                    </div>
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
