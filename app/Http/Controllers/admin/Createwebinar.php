<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Createwebinarmodel;
use Illuminate\Support\Facades\Storage;

class Createwebinar extends Controller
{
    /**
     * Show all webinars
     */
    public function index()
    {
        $webinars = Createwebinarmodel::latest()->get();
        return view('admin.createwebinar.index', compact('webinars'));
    }

    /**
     * Show create webinar form
     */
    public function create()
    {

        return view('admin.createwebinar.create');
    }

    /**
     * Store new webinar
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateWebinar($request);

        if ($request->hasFile('banner')) {
            $validatedData['banner'] = $request->file('banner')->store('banners', 'public');
        }

        Createwebinarmodel::create($validatedData);

        return redirect()->route('admin.createwebinar.index')->with('success', 'Webinar created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $webinar = Createwebinarmodel::findOrFail($id);
        return view('admin.createwebinar.edit', compact('webinar'));
    }

    /**
     * Update webinar
     */
    public function update(Request $request, $id)
    {
        $webinar = Createwebinarmodel::findOrFail($id);
        $validatedData = $this->validateWebinar($request);

        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($webinar->banner) {
                Storage::disk('public')->delete($webinar->banner);
            }
            $validatedData['banner'] = $request->file('banner')->store('banners', 'public');
        }

        $webinar->update($validatedData);

        return redirect()->route('admin.createwebinar.index')->with('success', 'Webinar updated successfully!');
    }

    /**
     * Delete webinar
     */
    public function destroy($id)
    {
        $webinar = Createwebinarmodel::findOrFail($id);

        if ($webinar->banner) {
            Storage::disk('public')->delete($webinar->banner);
        }

        $webinar->delete();

        return redirect()->route('admin.createwebinar.index')->with('success', 'Webinar deleted successfully!');
    }

    /**
     * Shared validation logic
     */
    protected function validateWebinar(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'reminder_reminder_time' => 'required|string|max:255',

            'status' => 'required|in:active,inactive',
            'speakers' => 'required|string|max:255',
            'speakers_designation' => 'required|string|max:255',
            'zoom_meeting_id' => 'nullable|string|max:255',
            'zoom_meeting_url' => 'nullable|url|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    }
}
