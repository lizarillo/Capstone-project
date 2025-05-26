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

class SuperAdminController extends Controller
{
    // Dashboard
  
    public function showSuperAdmin()
{
    $submissionCounts = [
        'submittedCount' => Submission::where('status', 'submitted')->count(),
        'pendingCount' => Submission::where('status', 'pending')->count(),
        'unsubmittedCount' => Submission::where('status', 'unsubmitted')->count(),
    ];

    $institutionSubmissions = Submission::join('institutions', 'submissions.institution_id', '=', 'institutions.id')
        ->select('institutions.name as institution', DB::raw('count(*) as submissions_count'))
        ->groupBy('institutions.name')
        ->get();

    $institutionCodes = ['ICET', 'IBEG', 'IARS', 'ITED', 'IMAS'];
    $institutionStats = [];

    foreach ($institutionCodes as $code) {
        $institution = Institution::where('code', $code)->first();
        $institutionStats[$code] = $institution
            ? Submission::where('institution_id', $institution->id)->count()
            : 0;
    }

    // ✅ This is the variable your Blade view needs:
    $loginLogs = AdminLog::with('admin')->latest()->get();

    $data = [
        'totalInstitutions' => Institution::count(),
        'registeredStudents' => Student::count(),
        'registeredAdmins' => User::where('role', 'admin')->count(),
        'admins' => User::whereIn('role', ['admin', 'superadmin'])->get(),
        'studentLoginHistory' => StudentLoginHistory::latest()->take(200)->get(),
        'adminLoginHistory' => $loginLogs->where('action', 'login')->take(10)->map(fn($log) => (object)[
            'admin_id' => optional($log->admin)->id,
            'firstname' => optional($log->admin)->firstname,
            'lastname' => optional($log->admin)->lastname,
            'email' => optional($log->admin)->email,
            'action' => $log->action,
            'ip_address' => $log->ip_address,
            'user_agent' => $log->user_agent,
            'is_active' => optional($log->admin)->status === 'active',
            'created_at' => $log->created_at,
        ]),
        'institutionStats' => $institutionStats,
        'institutionSubmissions' => $institutionSubmissions,
        'loginLogs' => $loginLogs, // ✅ Add this
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

        return view('superadmin.adminroles', compact('admins', 'archivedAdmins', 'loginLogs'));
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

    return view('superadmin.manageadmin', compact('admins'));
}









public function showAdministrators()
{
    $users = User::where('role', 'admin')->get(); // Adjust 'admin' to your actual role name
    return view('superadmin.manageadmin', compact('users')); // Adjust view path if needed
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
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['status'] = 'active';

        Admin::create($validated);

        return redirect()->route('superadmin.adminroles')->with('success', 'Admin added successfully.');
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


}
