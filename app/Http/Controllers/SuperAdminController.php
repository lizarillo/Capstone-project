<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\AdminLog;
use App\Models\Student;
use App\Models\Submission;
use App\Models\Institution;
use App\Models\StudentLoginHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    // Dashboard
  public function showSuperAdmin()
{
    // Mock counts for submissions
    $submissionCounts = [
        'submittedCount' => 10,
        'pendingCount' => 5,
        'unsubmittedCount' => 3,
    ];

    // Mock institution submissions
    $institutionSubmissions = collect([
        (object)['institution' => 'ICET', 'submissions_count' => 4],
        (object)['institution' => 'IBEG', 'submissions_count' => 3],
        (object)['institution' => 'IARS', 'submissions_count' => 2],
        (object)['institution' => 'ITED', 'submissions_count' => 5],
        (object)['institution' => 'IMAS', 'submissions_count' => 1],
    ]);

    // Mock institution stats
    $institutionStats = [
        'ICET' => 4,
        'IBEG' => 3,
        'IARS' => 2,
        'ITED' => 5,
        'IMAS' => 1,
    ];

    // Mock admin login logs
    $loginLogs = collect([
        (object)[
            'admin_id' => 1,
            'firstname' => 'Juan',
            'lastname' => 'Dela Cruz',
            'email' => 'juan@example.com',
            'action' => 'login',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'is_active' => true,
            'created_at' => now(),
        ]
    ]);

    // Main data to send to view
    $data = [
        'totalInstitutions' => 5,
        'registeredStudents' => 100,
        'registeredAdmins' => 3,
        'admins' => collect([
            (object)['firstname' => 'Juan', 'lastname' => 'Dela Cruz', 'role' => 'admin'],
            (object)['firstname' => 'Ana', 'lastname' => 'Santos', 'role' => 'superadmin'],
        ]),
        'studentLoginHistory' => collect([]), // empty for now
        'adminLoginHistory' => $loginLogs,
        'institutionStats' => $institutionStats,
        'institutionSubmissions' => $institutionSubmissions,
        'loginLogs' => $loginLogs,
    ];

    $data = array_merge($data, $submissionCounts);

    return view('superadmin.dashboard')->with($data);
}



    // Admin Management Page
    public function adminRoles()
    {
        $admins = Admin::whereNull('deleted_at')->get();
        $archivedAdmins = Admin::onlyTrashed()->get();

        $loginLogs = AdminLog::with('admin')->latest()->get()->map(function ($log) {
            return (object)[
                'admin_id' => optional($log->admin)->id,
                'firstname' => optional($log->admin)->firstname,
                'lastname' => optional($log->admin)->lastname,
                'email' => optional($log->admin)->email,
                'action' => $log->action,
                'is_active' => optional($log->admin)->status === 'active',
                'created_at' => $log->created_at,
            ];
        });

        return view('superadmin.manageadmin', compact('admins', 'archivedAdmins', 'loginLogs'));
    }

public function showAdministrators()
{
    $users = User::where('role', 'admin')->get(); // Adjust 'admin' to your actual role name
    return view('superadmin.manageadmin', compact('users')); // Adjust view path if needed
}




    public function someAdminView()
{
    $adminLoginHistory = AdminLog::with('admin')
        ->where('action', 'login')
        ->whereHas('admin', fn($q) => $q->where('role', 'admin'))
        ->latest()
        ->take(200)
        ->get()
        ->map(function ($log) {
            return (object)[
                'admin_id' => optional($log->admin)->id,
                'firstname' => optional($log->admin)->firstname,
                'lastname' => optional($log->admin)->lastname,
                'email' => optional($log->admin)->email,
                'is_active' => optional($log->admin)->status === 'active',
                'ip_address' => $log->ip_address,
                'user_agent' => $log->user_agent,
                'created_at' => $log->created_at,
            ];
        });

    $users = User::where('role', 'admin')->get();

    return view('superadmin.adminroles', compact('adminLoginHistory', 'users'));
}





    // Admin Management Index
   

public function index()
{
    $admins = User::where('role', 'admin')->get();
    $users = User::all();

    return view('superadmin.manageadmin', compact('admins', 'users'));

}


    public function studentSubmission()
    {
        return view('superadmin.studentSubmission');
    }

    public function editAdmin()
    {
        return view('superadmin.updateAccount', ['user' => Auth::user()]);
    }

    public function updateAdmin(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user->update($request->only('firstname', 'lastname', 'email'));

        if ($request->hasFile('profile_picture')) {
            $filename = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $filename, 'public');
            $user->update(['profile_picture' => $path]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }


public function store(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,superadmin',
    ]);

    User::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        // Removed 'status' since it's not in the users table
    ]);

    return redirect()->back()->with('success', 'Admin created successfully.');
}



    public function restore($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->restore();
            return back()->with('success', 'User restored successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Restoration failed: ' . $e->getMessage());
        }
    }

    public function restoreUser($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            return back()->with('success', 'User restored successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error restoring user: ' . $e->getMessage());
        }
    }

    public function exportPdf()
    {
        $submissionsPerInstitution = Submission::join('institutions', 'submissions.institution_id', '=', 'institutions.id')
            ->select('institutions.name as institution', DB::raw('count(*) as total'))
            ->groupBy('institutions.name')
            ->pluck('total', 'institution')
            ->toArray();

        $data = [
            'totalSubmitted' => Submission::where('status', 'submitted')->count(),
            'totalUnsubmitted' => Submission::where('status', 'unsubmitted')->count(),
            'totalPending' => Submission::where('status', 'pending')->count(),
            'submissionsPerInstitution' => $submissionsPerInstitution,
        ];

        $pdf = Pdf::loadView('superadmin.export', $data);

        return $pdf->download('analytics_report.pdf');
    }


   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $validated = $request->validate([
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:admin,superadmin',
    ]);

    $user->update($validated);

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Admin updated successfully!']);
    }

    return redirect()->back()->with('success', 'Admin updated successfully!');
}


public function destroy($id, Request $request)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'Admin not found.');
    }

    try {
        $user->delete();
        return redirect()->back()->with('success', 'Admin deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete admin.');
    }
}

public function studentActivity()
{
     return view('superadmin.studentActivity');
}
public function requestActivity()
{
     return view('superadmin.requestActivity');
}

}
