<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Createwebinarmodel;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function create()
    {
        // Fetch the latest active webinar
        $activeWebinar = Createwebinarmodel::where('status', 'active')
            ->latest()
            ->first();


        // dd($activeWebinar);
        // exit;
        return view('submission-form', compact('activeWebinar'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name'       => 'required|string|max:255',
    //         'email'      => 'required|email',
    //         'phone'      => 'required|string|max:15',
    //         'webinar_id' => 'required|exists:createwebinarmodels,id',
    //     ]);

    //     Submission::create($validated);

    //     return redirect()->back()->with('success', 'Data submitted successfully!');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:15',
            'webinar_id' => 'required|exists:' . (new Createwebinarmodel)->getTable() . ',id',
        ]);

        Submission::create($validated);

        return redirect()->back()->with('success', 'Data submitted successfully!');
    }
}
