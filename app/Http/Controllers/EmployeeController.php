<?php

namespace App\Http\Controllers;

use App\Models\Employee; // Import the Employee model
use App\Models\User;     // Import the User model
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display a listing of the employees
    public function index(Request $request)
    {
        // Fetch all employees with their associated users, applying search if provided
        $search = $request->input('search');
        $employees = Employee::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->orWhere('phone', 'like', "%$search%")
                             ->orWhereHas('user', function ($q) use ($search) {
                                 $q->where('id', $search); // Search by user ID
                             });
            })
            ->get();

        // Pass the employees to the view
        return view('admin.employees.home', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        // Fetch users to associate with the employee
        $users = User::all();
        return view('admin.employees.create', compact('users'));
    }

    // Store a newly created employee
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'job' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048', // Validate avatar as an image
            'documents' => 'nullable|file|max:2048', // Validate documents as a file
        ]);

        // Handle file uploads
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('documents')) {
            $data['documents'] = $request->file('documents')->store('documents', 'public');
        }

        // Create a new employee record
        Employee::create($data);

        // Redirect to the employee index with a success message
        return redirect()->route('admin.employees')->with('success', 'Employee added successfully.');
    }

    // Show the form for editing an employee
    public function edit(Employee $employee)
    {
        // Fetch users to associate with the employee
        $users = User::all();
        return view('admin.employees.edit', compact('employee', 'users'));
    }

    // Update an existing employee
    public function update(Request $request, Employee $employee)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|string|max:15',
            'job' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048', // Validate avatar as an image
            'documents' => 'nullable|file|max:2048', // Validate documents as a file
        ]);

        // Handle file uploads
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($employee->avatar) {
                \Storage::disk('public')->delete($employee->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('documents')) {
            // Delete old documents if exists
            if ($employee->documents) {
                \Storage::disk('public')->delete($employee->documents);
            }
            $data['documents'] = $request->file('documents')->store('documents', 'public');
        }

        // Update the employee record
        $employee->update($data);

        // Redirect to the employee index with a success message
        return redirect()->route('admin.employees')->with('success', 'Employee updated successfully.');
    }

    // Remove an employee from storage
    public function destroy(Employee $employee)
    {
        // Delete old files if they exist
        if ($employee->avatar) {
            \Storage::disk('public')->delete($employee->avatar);
        }
        if ($employee->documents) {
            \Storage::disk('public')->delete($employee->documents);
        }

        // Delete the employee record
        $employee->delete();

        // Redirect to the employee index with a success message
        return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
    }

    // Search for users based on input
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        // Search users by name, email, phone, or user ID
        $users = User::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%")
                         ->orWhere('email', 'like', "%$query%")
                         ->orWhere('phone', 'like', "%$query%")
                         ->orWhere('id', $query); // User ID can be searched exactly
        })->get();

        return response()->json($users);
    }

    // Show details of a single employee
    public function show(Employee $employee)
    {
        // Load the uploads for the employee
        $uploads = $employee->uploads; // Assuming there's a relationship defined

        return view('admin.employees.show', compact('employee', 'uploads'));
    }

     // Update the status of an employee (approve/reject)
     public function updateStatus(Request $request, Employee $employee)
     {
         // Validate the incoming request data
         $request->validate([
             'status' => 'required|in:approved,rejected'
         ]);

         // Update the employee's status
         $employee->status = $request->status;
         $employee->save();

         // Redirect back to the employee's show page with a success message
         return redirect()->route('admin.employees.show', $employee->id)
                          ->with('success', __('Status updated successfully.'));
     }

}
