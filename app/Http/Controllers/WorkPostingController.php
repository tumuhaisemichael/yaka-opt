<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Correct namespace for Employee model

class WorkPostingController extends Controller
{
    public function index()
    {
        // Fetch the employee record associated with the authenticated user
        $employee = Employee::where('user_id', auth()->id())->first();

        // Only allow access if the employee's status is "approved"
        if (!$employee || $employee->status !== 'approved') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to view the work posting.');
        }

        return view('user.work-posting', compact('employee'));
    }
}

