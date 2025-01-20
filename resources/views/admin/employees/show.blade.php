<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Employee Profile') }}</title>

    <!-- Bootstrap and Bootswatch CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $employee->name }} {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 d-flex h-screen">
        <!-- Sidebar -->
        <nav class="bg-white dark:bg-gray-800 w-64 min-h-screen p-4 rounded-lg shadow-md">
            <h3 class="text-gray-800 dark:text-white text-lg font-semibold mb-4">Admin Menu</h3>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition py-2">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.employees.index') }}" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition py-2">
                        <i class="fas fa-users me-2"></i>
                        {{ __('Employees') }}
                    </a>
                </li>
            </ul>
        </nav>

        <div class="flex-1 d-flex space-x-4">
            <!-- Additional Information Area -->
            <div class="flex-1 max-w-md bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Additional Information') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-2">You can add additional context or information related to the employee addition process.</p>
                <p class="text-gray-600 dark:text-gray-400">Ensure that all required details are filled before submitting the form.</p>
            </div>

            <!-- Employee Details Area -->
            <div class="flex-1 max-w-md bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md ms-3 mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Employee Details') }}</h3>

                <div class="flex items-start mb-4 justify-between">
                    <div class="flex-1">
                        <div class="space-y-3">
                            <p><strong>{{ __('Name:') }}</strong> {{ $employee->formatted_name }}</p>
                            <p><strong>{{ __('Email:') }}</strong> {{ $employee->email }}</p>
                            <p><strong>{{ __('Phone:') }}</strong> {{ $employee->full_phone_number }}</p>
                            <p><strong>{{ __('Job Title:') }}</strong> {{ $employee->job }}</p>
                            <p><strong>{{ __('Status:') }}</strong>
                                <span class="inline-block px-2 py-1 rounded-full {{ $employee->status === 'approved' ? 'bg-green-500' : ($employee->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </p>

                            <!-- Added Fields -->
                            <p><strong>{{ __('Place Posted:') }}</strong> {{ $employee->place_posted ?? 'N/A' }}</p>
                            <p><strong>{{ __('Duration:') }}</strong> {{ $employee->duration ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="flex-shrink-0 ms-4">
                        <div class="avatar-box" style="width: 100px; height: 100px; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            @if ($employee->avatar)
                                <img src="{{ Storage::url($employee->avatar) }}" alt="{{ $employee->name }}'s Avatar" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full border border-gray-300 rounded shadow-lg flex items-center justify-center">
                                    <span class="text-gray-600">{{ __('No Avatar') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mt-2 mb-2">{{ __('Uploads') }}</h3>
                <div class="space-y-4">
                    @if ($employee->uploads && $employee->uploads->isNotEmpty())
                        <ul class="list-disc list-inside">
                            @foreach ($employee->uploads as $upload)
                                <li class="flex items-center justify-between">
                                    <span>
                                        <a href="{{ Storage::url($upload->path) }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ $upload->filename }}
                                        </a>
                                        <span class="text-gray-500">({{ $upload->created_at->diffForHumans() }})</span>
                                        <span class="text-gray-400"> - {{ __('Click to download') }}</span>
                                    </span>
                                    <span>
                                        <a href="{{ Storage::url($upload->path) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">{{ __('No uploads found for this employee.') }}</p>
                    @endif
                </div>

                <div class="mt-4 mb-4">
                    <h3 class="text-lg font-semibold">{{ __('Approval Status') }}</h3>
                    <form action="{{ route('admin.employees.updateStatus', $employee->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex space-x-2 mt-2">
                            <button type="submit" name="status" value="approved" class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i> {{ __('Approve') }}
                            </button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">
                                <i class="fas fa-times"></i> {{ __('Reject') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-4 mb-4">
                    <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-edit"></i> {{ __('Edit Employee') }}
                    </a>
                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> {{ __('Delete Employee') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

</body>
</html>
