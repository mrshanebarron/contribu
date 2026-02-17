<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsvpController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'attendance' => 'required|in:attending,not_attending,maybe',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        $couple = DB::table('couples')->where('slug', $slug)->firstOrFail();

        DB::table('rsvps')->insert([
            'couple_id' => $couple->id,
            'name' => $request->name,
            'email' => $request->email,
            'attendance' => $request->attendance,
            'guests' => $request->guests,
            'dietary_requirements' => $request->dietary_requirements,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Thank you for your RSVP! We can\'t wait to celebrate with you.');
    }
}
