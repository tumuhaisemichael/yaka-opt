<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Work Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($employee->status === 'approved')
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center">
                            <img src="{{ $employee->avatar }}" alt="{{ $employee->name }}'s Avatar" class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h3 class="text-xl font-bold">{{ $employee->name }}</h3>
                                <h3 class="text-lg text-gray-700">{{ $employee->job }}</h3>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-600">{{ __('Posted Place:') }}</p>
                                <p>{{ $employee->posted_place ?? 'Pending' }}</p> <!-- Placeholder for Posted Place -->
                            </div>
                            <div>
                                <p class="text-gray-600">{{ __('Duration:') }}</p>
                                <p>{{ $employee->duration ?? 'Pending' }}</p> <!-- Placeholder for Duration -->
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-red-500">{{ __('You are not authorized to view this page.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
