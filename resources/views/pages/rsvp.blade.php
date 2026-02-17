@extends('layouts.app')
@section('title', 'RSVP — ' . $couple->partner_one . ' & ' . $couple->partner_two)
@section('content')

<section class="bg-sage-900 pt-28 pb-8 lg:pt-36 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <a href="{{ route('wedding', $couple->slug) }}" class="inline-flex items-center gap-2 text-sage-300 text-sm hover:text-white transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Back to {{ $couple->partner_one }} & {{ $couple->partner_two }}'s Page
        </a>
    </div>
</section>

<section class="py-16 px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-10 reveal">
            <p class="text-sage-600 text-xs font-semibold uppercase tracking-widest mb-2">RSVP</p>
            <h1 class="font-serif text-4xl font-bold text-sage-900 mb-3">Will you join us?</h1>
            <p class="text-slate-500">{{ $couple->partner_one }} & {{ $couple->partner_two }} would love to know if you can make it to their wedding on {{ \Carbon\Carbon::parse($couple->wedding_date)->format('j F Y') }}.</p>
        </div>

        @if(session('success'))
            <div class="bg-sage-50 border border-sage-200 text-sage-700 rounded-xl p-6 text-center mb-8 reveal">
                <svg class="w-10 h-10 text-sage-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                <p class="font-semibold text-sage-900 mb-1">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white border border-sage-200 rounded-xl p-8 reveal" x-data="{ attendance: 'attending' }">
            <form action="{{ route('rsvp.store', $couple->slug) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    {{-- Attendance --}}
                    <div>
                        <label class="block text-sm font-medium text-sage-800 mb-3">Your response</label>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach([
                                ['attending', 'Attending', 'I\'ll be there!'],
                                ['maybe', 'Maybe', 'Not sure yet'],
                                ['not_attending', 'Can\'t Make It', 'Sorry!'],
                            ] as [$val, $label, $sub])
                                <label class="cursor-pointer">
                                    <input type="radio" name="attendance" value="{{ $val }}" x-model="attendance" class="sr-only peer">
                                    <div class="p-4 border border-sage-200 rounded-xl text-center peer-checked:border-sage-500 peer-checked:bg-sage-50 transition-colors hover:bg-sage-50/50">
                                        <div class="font-semibold text-sage-900 text-sm">{{ $label }}</div>
                                        <div class="text-slate-400 text-xs mt-0.5">{{ $sub }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-sage-800 mb-1">Your name</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                                   placeholder="Full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-sage-800 mb-1">Email</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                                   placeholder="your@email.com">
                        </div>
                    </div>

                    <div x-show="attendance === 'attending' || attendance === 'maybe'" x-transition>
                        <label class="block text-sm font-medium text-sage-800 mb-1">Number of guests (including you)</label>
                        <select name="guests"
                                class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none bg-white">
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'guest' : 'guests' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div x-show="attendance === 'attending' || attendance === 'maybe'" x-transition>
                        <label class="block text-sm font-medium text-sage-800 mb-1">Dietary requirements <span class="text-slate-400">(optional)</span></label>
                        <input type="text" name="dietary_requirements"
                               class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                               placeholder="e.g. Vegetarian, gluten free, nut allergy">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-sage-800 mb-1">Message for the couple <span class="text-slate-400">(optional)</span></label>
                        <textarea name="message" rows="3"
                                  class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none resize-none"
                                  placeholder="Share your well-wishes..."></textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors">
                        Send RSVP
                    </button>
                </div>
            </form>
        </div>

        {{-- Venue Info --}}
        <div class="mt-8 bg-sage-50 border border-sage-200 rounded-xl p-6 reveal">
            <h3 class="font-semibold text-sage-900 text-sm mb-3">Venue Details</h3>
            <div class="space-y-2 text-sm text-slate-600">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-sage-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    {{ $couple->venue }}, {{ $couple->location }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-sage-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                    {{ \Carbon\Carbon::parse($couple->wedding_date)->format('l, j F Y') }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-sage-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Ceremony begins at 3:00 PM
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
