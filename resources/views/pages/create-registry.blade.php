@extends('layouts.app')
@section('title', 'Create Your Registry')
@section('content')

<section class="bg-sage-900 pt-28 pb-16 lg:pt-36 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <p class="text-sage-400 text-xs font-semibold uppercase tracking-widest mb-3">Get Started</p>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-white mb-4">Create your gift registry</h1>
        <p class="text-sage-200 text-lg max-w-xl mx-auto">Set up your personalized wedding page and start adding gifts in under five minutes. No credit card required.</p>
    </div>
</section>

{{-- Steps Preview --}}
<section class="py-20 px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach([
                ['1', 'Create your page', 'Add your names, date, venue, and your love story. Upload a photo and choose your page style.'],
                ['2', 'Add your gifts', 'Build your wishlist with images, descriptions, and goal amounts. Unlimited items, edit anytime.'],
                ['3', 'Share & celebrate', 'Share your unique link. Guests contribute directly — no accounts needed, no fuss.'],
            ] as [$num, $title, $desc])
                <div class="text-center reveal">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-sage-600 text-white font-bold flex items-center justify-center">{{ $num }}</div>
                    <h3 class="font-serif text-lg font-bold text-sage-900 mb-2">{{ $title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>

        {{-- Demo Form --}}
        <div class="bg-white border border-sage-200 rounded-xl p-8 md:p-10 reveal">
            <div class="text-center mb-8">
                <h2 class="font-serif text-2xl font-bold text-sage-900 mb-2">Let's get started</h2>
                <p class="text-slate-500 text-sm">Fill in the basics — you can always edit these later.</p>
            </div>

            <form class="space-y-6" onsubmit="event.preventDefault(); document.getElementById('demo-notice').classList.remove('hidden');">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-sage-800 mb-1">Partner one</label>
                        <input type="text" class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="First name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-sage-800 mb-1">Partner two</label>
                        <input type="text" class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="First name">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-sage-800 mb-1">Wedding date</label>
                    <input type="date" class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-sage-800 mb-1">Venue name</label>
                    <input type="text" class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="e.g. Stones of the Yarra Valley">
                </div>

                <div>
                    <label class="block text-sm font-medium text-sage-800 mb-1">Your email</label>
                    <input type="email" class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="you@email.com">
                </div>

                <button type="submit" class="w-full py-3 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors">Create My Registry</button>

                <div id="demo-notice" class="hidden bg-sage-50 border border-sage-200 rounded-lg p-4 text-center">
                    <p class="text-sage-700 text-sm font-semibold">This is a demo — registration would create your account here.</p>
                    <a href="{{ route('wedding', 'emma-and-liam') }}" class="text-sage-600 text-sm font-semibold hover:text-sage-700 mt-1 inline-block">View a sample registry instead &rarr;</a>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="py-20 px-6 lg:px-8 bg-sage-50/50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 reveal">
            <h2 class="font-serif text-3xl font-bold text-sage-900">Everything you need, nothing you don't</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Unlimited gifts', 'Add as many items as you want. Honeymoons, appliances, experiences, charity — anything goes.', 'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
                ['Group funding', 'Multiple guests contribute toward one gift. Big dreams funded by collective generosity.', 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
                ['Progress tracking', 'Real-time progress bars show guests what\'s funded and what still needs love.', 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
                ['RSVP built in', 'Guests can RSVP right from your page — including guest count and dietary needs.', 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.746 3.746 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z'],
                ['Secure payments', 'Stripe handles all transactions. PCI compliant, instant receipts, bank-level security.', 'M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['Mobile perfect', 'Beautiful on every device. Your guests can contribute from anywhere, anytime.', 'M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3'],
            ] as [$title, $desc, $icon])
                <div class="bg-white border border-sage-100 rounded-xl p-6 reveal">
                    <svg class="w-6 h-6 text-sage-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                    <h3 class="font-semibold text-sage-900 mb-2">{{ $title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 px-6 lg:px-8 bg-sage-600">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 class="font-serif text-3xl font-bold text-white mb-4">Your wedding, your way</h2>
        <p class="text-sage-100 mb-8">No forced gift lists. No awkward returns. Just the things you actually want, funded by the people who love you.</p>
        <a href="{{ route('wedding', 'emma-and-liam') }}" class="px-8 py-3.5 bg-white text-sage-700 font-bold rounded-lg hover:bg-cream-100 transition-colors">Explore the Demo</a>
    </div>
</section>

@endsection
