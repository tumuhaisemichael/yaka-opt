<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display the user update form
    public function edit()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        // Retrieve the corresponding Employee record
        $employee = Employee::where('user_id', $user->id)->first();

        return view('user.update', compact('user', 'employee')); // Pass both user and employee data to the view
    }

    // Process the update form submission
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'job' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'documents' => 'nullable|file|max:2048',
        ]);

        // Prepare employee data for storage
        $employeeData = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => Auth::user()->email, // Keep the email from the user table
            'phone' => $request->phone,
            'job' => $request->job,
            'status' => 'pending', // Set status to pending for approval
        ];

        // Create or update employee record
        $employee = Employee::updateOrCreate(
            ['user_id' => Auth::id()],
            $employeeData
        );

        // Handle file uploads
        $this->handleFileUploads($request, $employee);

        return redirect()->route('user.update')->with('success', 'Your information has been submitted for approval.');
    }

    // Handle file uploads
    private function handleFileUploads(Request $request, Employee $employee)
    {
        if ($request->hasFile('avatar')) {
            $employee->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('documents')) {
            $employee->documents = $request->file('documents')->store('documents', 'public');
        }

        $employee->save(); // Save changes
    }

    public function index()
    {

        return view('user.cost');
    }
    public function appliances()
    {
        return view('user.appliances');
    }

    public function connect()
    {
        return view('user.connect');
    }



}

