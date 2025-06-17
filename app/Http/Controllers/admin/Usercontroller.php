<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubmission;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = UserSubmission::all();
        return view('admin.user.index', compact('users'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:csv,txt,xlsx,xls'
        ]);

        $file = $request->file('import_file');

        // Only process CSV directly (no Excel reader used)
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return back()->with('error', 'Unable to read the file.');
        }

        $header = fgetcsv($handle); // Skip header row

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 3) {
                continue; // Skip incomplete rows
            }

            // Basic required field check
            $email = trim($row[2]);
            if ($email === '') {
                continue;
            }

            UserSubmission::updateOrCreate(
                ['email' => $email], // Unique identifier
                [
                    'name' => trim($row[0]),
                    'phone' => trim($row[1]),
                    'email' => $email,
                    'Invite_Sent' => $row[3] ?? 'False',
                    'calendar_response' => $row[4] ?? 'pending',
                    'meeting_datetime' => $row[5] ?? null,
                    'synced' => isset($row[6]) && $row[6] == 1 ? 1 : 0,
                    'reminder_sent' => isset($row[7]) && $row[7] == 1 ? 1 : 0,
                    'attendance_status' => $row[8] ?? 'registered',
                    'calendar_sync_status' => $row[9] ?? 'pending',
                    'last_updated' => now()
                ]
            );
        }

        fclose($handle);

        return back()->with('success', 'Users imported successfully.');
    }
}
