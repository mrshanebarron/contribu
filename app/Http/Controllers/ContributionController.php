<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{
    public function store(Request $request, string $slug, int $giftId)
    {
        $request->validate([
            'contributor_name' => 'required|string|max:255',
            'contributor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:5',
        ]);

        $couple = DB::table('couples')->where('slug', $slug)->firstOrFail();
        $gift = DB::table('gifts')->where('id', $giftId)->where('couple_id', $couple->id)->firstOrFail();

        DB::table('contributions')->insert([
            'gift_id' => $gift->id,
            'contributor_name' => $request->contributor_name,
            'contributor_email' => $request->contributor_email,
            'amount' => $request->amount,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('gifts')->where('id', $gift->id)->increment('funded_amount', $request->amount);

        return back()->with('success', 'Thank you for your generous contribution!');
    }
}
