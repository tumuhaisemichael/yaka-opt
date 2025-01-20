<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Employees Tab Card -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-success-900 dark:text-gray-100">{{ __('Employees') }}</h3>
                        <p class="text-success-600 dark:text-success-400">{{ __('View and manage all employees.') }}</p>
                        <a href="{{ route('admin.employees.index') }}" class="mt-4 inline-block bg-blue-500 text-success py-2 px-4 rounded-lg hover:bg-blue-600">{{ __('View Employees') }}</a>
                    </div>
                </div>

                <!-- Add Employee Tab Card -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-success-900 dark:text-gray-100">{{ __('Add Employee') }}</h3>
                        <p class="text-success-600 dark:text-success-400">{{ __('Add a new employee to the system.') }}</p>
                        <a href="{{ route('admin.employees.create') }}" class="mt-4 inline-block bg-green-500 text-success py-2 px-4 rounded-lg hover:bg-green-600">{{ __('Add Employee') }}</a>
                    </div>
                </div>

                <!-- Approve Tab Card -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-success-900 dark:text-gray-100">{{ __('Approve Employee Requests') }}</h3>
                        <p class="text-success-600 dark:text-success-400">{{ __('Review and approve employee requests.') }}</p>
                        <a href="#" class="mt-4 inline-block bg-yellow-500 text-success py-2 px-4 rounded-lg hover:bg-yellow-600">{{ __('Approve Requests') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
