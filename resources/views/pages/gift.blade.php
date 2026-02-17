@extends('layouts.app')
@section('title', $gift->title . ' — ' . $couple->partner_one . ' & ' . $couple->partner_two)
@section('content')

<section class="bg-sage-900 pt-28 pb-8 lg:pt-36 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <a href="{{ route('wedding', $couple->slug) }}" class="inline-flex items-center gap-2 text-sage-300 text-sm hover:text-white transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Back to {{ $couple->partner_one }} & {{ $couple->partner_two }}'s Registry
        </a>
    </div>
</section>

<section class="py-12 px-6 lg:px-8 -mt-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            {{-- Main --}}
            <div class="lg:col-span-3 reveal">
                @if($gift->image)
                    <img src="{{ $gift->image }}" alt="{{ $gift->title }}" class="w-full aspect-[3/2] object-cover rounded-xl shadow-lg mb-8">
                @endif

                <h1 class="font-serif text-3xl md:text-4xl font-bold text-sage-900 mb-4">{{ $gift->title }}</h1>
                <p class="text-slate-600 leading-relaxed text-lg mb-8">{{ $gift->description }}</p>

                {{-- Progress --}}
                @php
                    $percent = $gift->goal_amount > 0 ? min(100, ($gift->funded_amount / $gift->goal_amount) * 100) : 0;
                    $remaining = max(0, $gift->goal_amount - $gift->funded_amount);
                    $fullyFunded = $gift->funded_amount >= $gift->goal_amount;
                @endphp
                <div class="bg-sage-50 border border-sage-200 rounded-xl p-6 mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <span class="font-serif text-3xl font-bold text-sage-700">${{ number_format($gift->funded_amount) }}</span>
                            <span class="text-slate-500 text-sm ml-1">of ${{ number_format($gift->goal_amount) }}</span>
                        </div>
                        <span class="text-sage-600 font-bold text-lg">{{ round($percent) }}%</span>
                    </div>
                    <div class="w-full bg-sage-200 rounded-full h-3 mb-3">
                        <div class="bg-sage-500 rounded-full h-3 transition-all" style="width: {{ $percent }}%"></div>
                    </div>
                    @if(!$fullyFunded)
                        <p class="text-slate-500 text-sm">${{ number_format($remaining) }} still needed &middot; {{ $contributions->count() }} contributions so far</p>
                    @else
                        <p class="text-sage-600 text-sm font-semibold">This gift has been fully funded! Thank you to everyone who contributed.</p>
                    @endif
                </div>

                {{-- Recent Contributions --}}
                @if($contributions->count())
                    <h3 class="font-serif text-xl font-bold text-sage-900 mb-4">Recent contributions</h3>
                    <div class="space-y-4 mb-8">
                        @foreach($contributions->take(6) as $contribution)
                            <div class="flex items-start gap-4 p-4 bg-white border border-sage-100 rounded-xl">
                                <div class="w-10 h-10 rounded-full bg-sage-100 flex items-center justify-center shrink-0">
                                    <span class="text-sage-600 font-bold text-sm">{{ substr($contribution->contributor_name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-sage-900 text-sm">{{ $contribution->contributor_name }}</span>
                                        <span class="text-sage-600 font-bold text-sm">${{ number_format($contribution->amount) }}</span>
                                    </div>
                                    @if($contribution->message)
                                        <p class="text-slate-500 text-sm mt-1 italic">"{{ $contribution->message }}"</p>
                                    @endif
                                    <p class="text-slate-400 text-xs mt-1">{{ \Carbon\Carbon::parse($contribution->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-2 reveal" style="transition-delay: 150ms">
                <div class="sticky top-24 space-y-6">
                    {{-- Contribution Form --}}
                    <div class="bg-white border border-sage-200 rounded-xl p-6">
                        <h3 class="font-serif text-xl font-bold text-sage-900 mb-1">Contribute to this gift</h3>
                        <p class="text-slate-500 text-sm mb-6">Every contribution, big or small, brings them closer to their goal.</p>

                        @if(session('success'))
                            <div class="bg-sage-50 border border-sage-200 text-sage-700 rounded-lg p-4 mb-6 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contribute', ['slug' => $couple->slug, 'gift' => $gift->id]) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                {{-- Quick amounts --}}
                                <div x-data="{ amount: '' }">
                                    <label class="block text-sm font-medium text-sage-800 mb-2">Amount (AUD)</label>
                                    <div class="grid grid-cols-4 gap-2 mb-3">
                                        @foreach([25, 50, 100, 250] as $amt)
                                            <button type="button" @click="amount = {{ $amt }}; $refs.amountInput.value = {{ $amt }}"
                                                    class="py-2 border border-sage-200 rounded-lg text-sm font-semibold text-sage-700 hover:bg-sage-50 hover:border-sage-400 transition-colors"
                                                    :class="amount == {{ $amt }} ? 'bg-sage-50 border-sage-500' : ''">
                                                ${{ $amt }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">$</span>
                                        <input type="number" name="amount" x-ref="amountInput" x-model="amount" min="5" step="1" required
                                               class="w-full pl-7 pr-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                                               placeholder="Or enter a custom amount">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-sage-800 mb-1">Your name</label>
                                    <input type="text" name="contributor_name" required
                                           class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                                           placeholder="e.g. Sarah & Mike">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-sage-800 mb-1">Email</label>
                                    <input type="email" name="contributor_email" required
                                           class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none"
                                           placeholder="For your receipt">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-sage-800 mb-1">Personal message <span class="text-slate-400">(optional)</span></label>
                                    <textarea name="message" rows="3"
                                              class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none resize-none"
                                              placeholder="Write a message to the couple..."></textarea>
                                </div>

                                <button type="submit"
                                        class="w-full py-3 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors">
                                    Contribute Now
                                </button>

                                <p class="text-slate-400 text-xs text-center">Payments processed securely via Stripe</p>
                            </div>
                        </form>
                    </div>

                    {{-- Couple Info --}}
                    <div class="bg-sage-50 border border-sage-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ $couple->photo }}" alt="{{ $couple->partner_one }} & {{ $couple->partner_two }}" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-sage-900 text-sm">{{ $couple->partner_one }} & {{ $couple->partner_two }}</h4>
                                <p class="text-slate-500 text-xs">{{ \Carbon\Carbon::parse($couple->wedding_date)->format('j F Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('wedding', $couple->slug) }}" class="text-sage-600 text-sm font-semibold hover:text-sage-700 transition-colors">View full registry &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
