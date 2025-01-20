<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">

    <div class="py-6 d-flex justify-content-center">
        <div class="d-flex w-100 max-w-6xl" style="padding: 0 15px;">
            <!-- Sidebar -->
            <nav class="bg-light dark:bg-gray-800" style="width: 250px; min-height: 100vh; padding: 20px;">
                <h3 class="text-dark dark:text-white text-lg font-semibold mb-4 text-center">Admin Menu</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-dark dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 py-3">
                            <i class="fas fa-tachometer-alt me-3 fa-lg"></i>
                            <span class="text-lg" style="margin-left: 10px;">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.employees.index') }}" class="d-flex align-items-center text-dark dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 py-3">
                            <i class="fas fa-users me-3 fa-lg"></i>
                            <span class="text-lg" style="margin-left: 10px;">{{ __('Employees') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="flex-grow p-4" style="min-width: 0; margin-left: 5px; margin-right: 5px;">
                <div class="d-flex gap-4">
                    <!-- Additional Information Section -->
                    <div class="flex-grow bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4" style="flex: 1 1 70%; height: 400px; margin-right: 20px;">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Additional Information') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">Manage employee applications from this dashboard.</p>
                        <p class="text-gray-600 dark:text-gray-400">Use the search function to quickly find specific employees.</p>
                    </div>

                    <!-- Employee Applications Section -->
                    <div class="flex-grow bg-white dark:bg-gray-800 shadow-md rounded-lg p-4" style="flex: 1 1 90%; height: 400px;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Employee Applications') }}</h3>
                            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> {{ __('Add Employee') }}
                            </a>
                        </div>

                        <!-- Search Field -->
                        <div class="mb-4">
                            <form action="{{ route('admin.employees.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" placeholder="{{ __('Search by name, email or contact....') }}" class="form-control me-2" style="width:500px;" />
                                <button type="submit" class="btn" style="color: green; background: none; border: none; padding: 0; margin-left: 20px;">
                                    <i class="fas fa-search" style="font-size: 1.2rem; margin-left: 20px;"></i>
                                </button>
                            </form>
                        </div>

                        @if ($employees->isEmpty())
                            <div class="alert alert-warning">
                                {{ __('No employee applications found.') }}
                            </div>
                        @else
                            <div class="table-responsive" style="height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-striped" style="min-width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Job') }}</th>
                                            <th>{{ __('Place Posted') }}</th> <!-- Added Place Posted -->
                                            <th>{{ __('Duration') }}</th> <!-- Added Duration -->
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>{{ $employee->job }}</td>
                                                <td>{{ $employee->posted_place ?? 'Pending' }}</td> <!-- Show 'Pending' if no value -->
                                                <td>{{ $employee->duration ?? 'Pending' }}</td> <!-- Show 'Pending' if no value -->
                                                <td>
                                                    <span class="badge {{ $employee->status === 'approved' ? 'bg-success' : ($employee->status === 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                                        {{ ucfirst($employee->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.employees.show', $employee->id) }}" class="text-primary">
                                                        <i class="fas fa-eye"></i> {{ __('View') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for responsive features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
