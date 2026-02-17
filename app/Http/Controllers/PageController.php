<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        $stats = [
            'couples' => DB::table('couples')->count(),
            'gifts' => DB::table('gifts')->count(),
            'funded' => '$' . number_format(DB::table('contributions')->sum('amount')),
            'fully_funded' => DB::table('gifts')->whereColumn('funded_amount', '>=', 'goal_amount')->count(),
        ];

        return view('pages.home', compact('stats'));
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function createRegistry()
    {
        return view('pages.create-registry');
    }

    public function wedding(string $slug)
    {
        $couple = DB::table('couples')->where('slug', $slug)->firstOrFail();
        $gifts = DB::table('gifts')->where('couple_id', $couple->id)->orderBy('sort_order')->get();
        $rsvpStats = [
            'attending' => DB::table('rsvps')->where('couple_id', $couple->id)->where('attendance', 'attending')->sum('guests'),
            'total' => DB::table('rsvps')->where('couple_id', $couple->id)->count(),
        ];

        return view('pages.wedding', compact('couple', 'gifts', 'rsvpStats'));
    }

    public function gift(string $slug, int $giftId)
    {
        $couple = DB::table('couples')->where('slug', $slug)->firstOrFail();
        $gift = DB::table('gifts')->where('id', $giftId)->where('couple_id', $couple->id)->firstOrFail();
        $contributions = DB::table('contributions')->where('gift_id', $gift->id)->orderByDesc('created_at')->get();

        return view('pages.gift', compact('couple', 'gift', 'contributions'));
    }

    public function rsvp(string $slug)
    {
        $couple = DB::table('couples')->where('slug', $slug)->firstOrFail();

        return view('pages.rsvp', compact('couple'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
