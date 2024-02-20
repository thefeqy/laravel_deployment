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


                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="mt-5 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Title') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                      {{ __('Description') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                      {{ __('Assigned name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                      {{ __('Admin name') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $task->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                      {{ Str::substr($task->description, 0, 50) }} ...
                                    </td>
                                    <td class="px-6 py-4">
                                      {{ $task->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                      {{ $task->admin->name }}
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-4xl">{{ __('No tasks found') }}</p>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="p-3">
                          {!! $tasks->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
