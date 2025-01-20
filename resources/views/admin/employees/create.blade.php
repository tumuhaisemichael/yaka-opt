<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Employee') }}
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
                    <div class="flex-grow bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-4" style="flex: 1 1 70%;">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Additional Information') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">You can add additional context or information related to the employee addition process.</p>
                        <p class="text-gray-600 dark:text-gray-400">Ensure that all required details are filled before submitting the form.</p>
                    </div>

                    <!-- Employee Form Section -->
                    <div class="flex-grow bg-white dark:bg-gray-800 shadow-md rounded-lg p-4" style="flex: 1 1 90%;">
                        <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data" id="employee-form">
                            @csrf

                            <!-- Search Field -->
                            <div class="mb-4">
                                <label for="user-search" class="form-label">{{ __('Search User') }}</label>
                                <div class="d-flex">
                                    <input type="text" id="user-search" name="user-search" placeholder="{{ __('Search by name, email, or ID') }}" class="form-control me-2" style="width: 200px;">
                                    <button type="button" class="btn btn-outline-success" id="search-button" style="margin-left: 20px;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div id="user-results" class="mt-1 bg-white rounded-md shadow-lg hidden"></div>
                            </div>

                            <!-- Side-by-Side Fields -->
                            <div class="row mb-3">
                                <!-- Name Field -->
                                <div class="col">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('Employee name') }}" required readonly>
                                </div>

                                <!-- Phone Field -->
                                <div class="col">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="{{ __('Employee phone number') }}" required readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Email Field -->
                                <div class="col">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Employee email') }}" required readonly>
                                </div>

                                <!-- Job Title Field -->
                                <div class="col">
                                    <label for="job" class="form-label">{{ __('Job Title') }}</label>
                                    <input type="text" id="job" name="job" class="form-control" placeholder="{{ __('Enter job title') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Place Posted Field -->
                                <div class="col">
                                    <label for="posted_place" class="form-label">{{ __('Place Posted') }}</label>
                                    <input type="text" id="posted_place" name="posted_place" class="form-control" placeholder="{{ __('Enter posted place') }}" required>
                                </div>

                                <!-- Duration Field -->
                                <div class="col">
                                    <label for="duration" class="form-label">{{ __('Duration') }}</label>
                                    <input type="text" id="duration" name="duration" class="form-control" placeholder="{{ __('Enter duration (e.g., 6 months)') }}" required>
                                </div>
                            </div>

                            <!-- Avatar Upload -->
                            <div class="mb-3">
                                <label for="avatar" class="form-label">{{ __('Avatar (Optional)') }}</label>
                                <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                            </div>

                            <!-- Document Upload -->
                            <div class="mb-3">
                                <label for="documents" class="form-label">{{ __('Documents (Optional)') }}</label>
                                <input type="file" id="documents" name="documents" class="form-control" accept="*">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('user-search');
            const resultsDiv = document.getElementById('user-results');

            searchInput.addEventListener('input', function () {
                const query = this.value;

                if (query.length > 2) {
                    fetch(`/search/users?query=${query}`)
                        .then(response => response.json())
                        .then(users => {
                            resultsDiv.innerHTML = '';
                            if (users.length > 0) {
                                users.forEach(user => {
                                    const userItem = document.createElement('div');
                                    userItem.textContent = `${user.name} (${user.email})`;
                                    userItem.classList.add('cursor-pointer', 'p-2', 'hover:bg-gray-200');
                                    userItem.onclick = () => {
                                        document.getElementById('name').value = user.name;
                                        document.getElementById('email').value = user.email;
                                        document.getElementById('phone').value = user.phone; // Assuming you have this field in User model
                                        resultsDiv.classList.add('hidden');
                                    };
                                    resultsDiv.appendChild(userItem);
                                });
                                resultsDiv.classList.remove('hidden');
                            } else {
                                resultsDiv.classList.add('hidden');
                            }
                        });
                } else {
                    resultsDiv.classList.add('hidden');
                }
            });

            // Hide results when clicking outside
            document.addEventListener('click', function (e) {
                if (!resultsDiv.contains(e.target) && e.target !== searchInput) {
                    resultsDiv.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Bootstrap JS (optional, for responsive features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
