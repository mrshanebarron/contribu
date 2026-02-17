@extends('layouts.app')
@section('title', $couple->partner_one . ' & ' . $couple->partner_two)
@section('content')

{{-- Hero --}}
<section class="relative min-h-[60vh] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $couple->cover_photo }}" alt="Wedding venue" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-sage-900/90 via-sage-900/40 to-transparent"></div>
    </div>
    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-8 pb-12 pt-32">
        <div class="flex flex-col md:flex-row items-end justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ $couple->photo }}" alt="{{ $couple->partner_one }} & {{ $couple->partner_two }}" class="w-16 h-16 rounded-full object-cover border-2 border-white/50 shadow-lg">
                    <div>
                        <h1 class="font-serif text-4xl md:text-5xl font-bold text-white">{{ $couple->partner_one }} <span class="text-sage-300">&</span> {{ $couple->partner_two }}</h1>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 text-sage-200 text-sm mt-4">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        {{ \Carbon\Carbon::parse($couple->wedding_date)->format('j F Y') }}
                    </span>
                    @if($couple->venue)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            {{ $couple->venue }}, {{ $couple->location }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('rsvp', $couple->slug) }}" class="px-6 py-2.5 bg-white text-sage-800 font-semibold rounded-lg hover:bg-cream-100 transition-colors text-sm">RSVP</a>
                <a href="#gifts" class="px-6 py-2.5 border border-white/30 text-white font-semibold rounded-lg hover:bg-white/10 transition-colors text-sm">View Gifts</a>
            </div>
        </div>
    </div>
</section>

{{-- Countdown & Stats --}}
<section class="bg-white border-b border-sage-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-6">
        @php
            $daysUntil = max(0, (int) now()->diffInDays(\Carbon\Carbon::parse($couple->wedding_date), false));
            $totalGoal = $gifts->sum('goal_amount');
            $totalFunded = $gifts->sum('funded_amount');
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="font-serif text-3xl font-bold text-sage-700">{{ $daysUntil }}</div>
                <div class="text-slate-500 text-sm">days to go</div>
            </div>
            <div>
                <div class="font-serif text-3xl font-bold text-sage-700">{{ $gifts->count() }}</div>
                <div class="text-slate-500 text-sm">gifts on wishlist</div>
            </div>
            <div>
                <div class="font-serif text-3xl font-bold text-sage-700">${{ number_format($totalFunded) }}</div>
                <div class="text-slate-500 text-sm">contributed</div>
            </div>
            <div>
                <div class="font-serif text-3xl font-bold text-sage-700">{{ $rsvpStats['attending'] }}</div>
                <div class="text-slate-500 text-sm">guests attending</div>
            </div>
        </div>
    </div>
</section>

{{-- Our Story --}}
@if($couple->story)
<section class="py-16 px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center reveal">
        <p class="text-sage-600 text-xs font-semibold uppercase tracking-widest mb-3">Our Story</p>
        <p class="font-serif text-xl text-slate-600 leading-relaxed italic">{{ $couple->story }}</p>
    </div>
</section>
@endif

{{-- Overall Progress --}}
<section class="px-6 lg:px-8 pb-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-sage-50 border border-sage-200 rounded-xl p-6 reveal">
            <div class="flex items-center justify-between mb-3">
                <span class="font-semibold text-sage-900">Overall registry progress</span>
                <span class="text-sage-600 font-semibold">${{ number_format($totalFunded) }} of ${{ number_format($totalGoal) }}</span>
            </div>
            <div class="w-full bg-sage-200 rounded-full h-3">
                <div class="bg-sage-500 rounded-full h-3 transition-all duration-500" style="width: {{ $totalGoal > 0 ? min(100, ($totalFunded / $totalGoal) * 100) : 0 }}%"></div>
            </div>
            <p class="text-sage-500 text-sm mt-2">{{ $totalGoal > 0 ? round(($totalFunded / $totalGoal) * 100) : 0 }}% funded &middot; {{ $gifts->where('funded_amount', '>=', DB::raw('goal_amount'))->count() }} gifts fully funded</p>
        </div>
    </div>
</section>

{{-- Gift Registry --}}
<section id="gifts" class="py-12 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8 reveal">
            <div>
                <h2 class="font-serif text-3xl font-bold text-sage-900">Gift Registry</h2>
                <p class="text-slate-500 text-sm mt-1">Contribute any amount toward the gifts they love</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($gifts as $gift)
                @php
                    $percent = $gift->goal_amount > 0 ? min(100, ($gift->funded_amount / $gift->goal_amount) * 100) : 0;
                    $fullyFunded = $gift->funded_amount >= $gift->goal_amount;
                @endphp
                <a href="{{ route('gift', ['slug' => $couple->slug, 'gift' => $gift->id]) }}"
                   class="group bg-white rounded-xl overflow-hidden border border-sage-100 hover:shadow-lg hover:border-sage-200 transition-all reveal {{ $fullyFunded ? 'opacity-75' : '' }}">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        @if($gift->image)
                            <img src="{{ $gift->image }}" alt="{{ $gift->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-sage-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-sage-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                            </div>
                        @endif
                        @if($fullyFunded)
                            <div class="absolute top-3 right-3 px-3 py-1 bg-sage-600 text-white text-xs font-bold uppercase rounded-full">Fully Funded</div>
                        @elseif($gift->priority === 'high')
                            <div class="absolute top-3 right-3 px-3 py-1 bg-blush-400 text-white text-xs font-bold uppercase rounded-full">Top Pick</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-serif text-lg font-bold text-sage-900 mb-1 group-hover:text-sage-600 transition-colors">{{ $gift->title }}</h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $gift->description }}</p>
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-sage-600 font-semibold">${{ number_format($gift->funded_amount) }}</span>
                            <span class="text-slate-400">of ${{ number_format($gift->goal_amount) }}</span>
                        </div>
                        <div class="w-full bg-sage-100 rounded-full h-2">
                            <div class="bg-sage-500 rounded-full h-2 transition-all" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- RSVP CTA --}}
<section class="py-16 px-6 lg:px-8 bg-sage-600">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 class="font-serif text-3xl font-bold text-white mb-4">Will you be there?</h2>
        <p class="text-sage-100 mb-8">Let {{ $couple->partner_one }} & {{ $couple->partner_two }} know if you can make it.</p>
        <a href="{{ route('rsvp', $couple->slug) }}" class="px-8 py-3.5 bg-white text-sage-700 font-bold rounded-lg hover:bg-cream-100 transition-colors">RSVP Now</a>
    </div>
</section>

@endsection
