<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-black p-5">
                    <h3 class="text-2xl text-white">Top 10 Users with heights number of tasks</h3>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="mt-5 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('User') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Task count') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stats as $stat)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $stat->user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $stat->tasks_count }}
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-4xl">{{ __('No statistics found') }}</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
