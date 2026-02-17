@extends('layouts.app')
@section('title', 'Wedding Gift Registry')
@section('content')

{{-- Hero --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=1400&q=80" alt="Wedding celebration" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-sage-900/80 via-sage-900/50 to-transparent"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-32 lg:py-40">
        <div class="max-w-xl">
            <p class="font-sans text-sage-300 text-sm font-semibold uppercase tracking-widest mb-4 reveal">Australia's Group-Funded Gift Registry</p>
            <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] mb-6 reveal">The gifts you
                <em class="text-cream-200">actually</em> want</h1>
            <p class="text-sage-100 text-lg leading-relaxed mb-8 reveal">Create your wishlist. Share it with everyone. Let your loved ones contribute together toward the gifts that matter most to you.</p>
            <div class="flex flex-col sm:flex-row gap-4 reveal">
                <a href="{{ route('create-registry') }}" class="px-7 py-3.5 bg-white text-sage-800 font-semibold rounded-lg hover:bg-cream-100 transition-colors text-center">Create Your Registry</a>
                <a href="{{ route('wedding', 'emma-and-liam') }}" class="px-7 py-3.5 border border-white/30 text-white font-semibold rounded-lg hover:bg-white/10 transition-colors text-center">See a Demo</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="bg-white border-y border-sage-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach([
                ['1,200+', 'Couples registered'],
                ['8,400+', 'Gifts funded'],
                ['$2.4M+', 'Contributed'],
                ['98%', 'Satisfaction rate'],
            ] as [$number, $label])
                <div class="reveal">
                    <div class="font-serif text-2xl md:text-3xl font-bold text-sage-700">{{ $number }}</div>
                    <div class="text-slate-500 text-sm mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- How It Works --}}
<section class="py-24 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 reveal">
            <p class="font-sans text-sage-600 text-xs font-semibold uppercase tracking-widest mb-2">How It Works</p>
            <h2 class="font-serif text-4xl font-bold text-sage-900">Four simple steps</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['01', 'Create Your Page', 'Set up your wedding page with your story, date, and venue details. It takes less than five minutes.', 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25'],
                ['02', 'Add Your Gifts', 'Create your wishlist with images, descriptions, and goal amounts. No preloaded items — only what you truly want.', 'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
                ['03', 'Share With Guests', 'Send your unique link to wedding guests. They can browse, choose a gift, and contribute any amount.', 'M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z'],
                ['04', 'Receive & Celebrate', 'Watch the progress bars fill as contributions come in. Funds go directly to you via Stripe.', 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z'],
            ] as [$num, $title, $desc, $icon])
                <div class="text-center reveal" style="transition-delay: {{ ($loop->index) * 100 }}ms">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-full bg-sage-50 border border-sage-200 flex items-center justify-center">
                        <svg class="w-6 h-6 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                    </div>
                    <span class="text-sage-400 font-serif text-sm font-medium">{{ $num }}</span>
                    <h3 class="font-serif text-xl font-bold text-sage-900 mt-1 mb-2">{{ $title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Registry --}}
<section class="py-24 px-6 lg:px-8 bg-sage-50/50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 reveal">
            <p class="font-sans text-sage-600 text-xs font-semibold uppercase tracking-widest mb-2">See It In Action</p>
            <h2 class="font-serif text-4xl font-bold text-sage-900">Emma & Liam's Registry</h2>
            <p class="text-slate-500 mt-3 max-w-lg mx-auto">See how a real registry looks — browse gifts, check progress, and explore what Contribu can do for your wedding.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $sampleGifts = DB::table('gifts')->orderBy('sort_order')->limit(3)->get();
            @endphp
            @foreach($sampleGifts as $gift)
                <a href="{{ route('gift', ['slug' => 'emma-and-liam', 'gift' => $gift->id]) }}" class="group bg-white rounded-xl overflow-hidden border border-sage-100 hover:shadow-lg hover:border-sage-200 transition-all reveal">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ $gift->image }}" alt="{{ $gift->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-5">
                        <h3 class="font-serif text-lg font-bold text-sage-900 mb-1 group-hover:text-sage-600 transition-colors">{{ $gift->title }}</h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $gift->description }}</p>
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-sage-600 font-semibold">${{ number_format($gift->funded_amount) }} raised</span>
                            <span class="text-slate-400">of ${{ number_format($gift->goal_amount) }}</span>
                        </div>
                        <div class="w-full bg-sage-100 rounded-full h-2">
                            <div class="bg-sage-500 rounded-full h-2 transition-all duration-500" style="width: {{ min(100, ($gift->funded_amount / $gift->goal_amount) * 100) }}%"></div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="text-center mt-10 reveal">
            <a href="{{ route('wedding', 'emma-and-liam') }}" class="inline-flex items-center gap-2 px-7 py-3 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors">
                View Full Registry
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Benefits --}}
<section class="py-24 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <p class="font-sans text-sage-600 text-xs font-semibold uppercase tracking-widest mb-2">Why Contribu</p>
                <h2 class="font-serif text-4xl font-bold text-sage-900 mb-6">A registry that works the way you live</h2>
                <div class="space-y-6">
                    @foreach([
                        ['Group Funding', 'Big-ticket items aren\'t off limits. Multiple guests can contribute to a single gift — so that honeymoon or appliance actually gets funded.'],
                        ['No More Duplicates', 'Guests see exactly what\'s needed and what\'s already funded. No awkward returns, no three toasters.'],
                        ['Your Gifts, Your Way', 'Add anything — experiences, home items, honeymoon funds, charity donations. If it matters to you, it belongs on your list.'],
                        ['Instant & Secure', 'Stripe-powered payments mean contributions land safely and instantly. Guests get receipts, you get peace of mind.'],
                    ] as [$title, $desc])
                        <div class="flex gap-4">
                            <div class="w-8 h-8 bg-sage-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-sage-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-sage-900 mb-1">{{ $title }}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="reveal" style="transition-delay: 150ms">
                <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&q=80" alt="Happy couple" class="rounded-xl w-full aspect-[4/5] object-cover shadow-xl">
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="py-24 px-6 lg:px-8 bg-sage-900">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14 reveal">
            <p class="text-sage-400 text-xs font-semibold uppercase tracking-widest mb-2">Real Couples</p>
            <h2 class="font-serif text-4xl font-bold text-white">What they're saying</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['We got our entire honeymoon funded through Contribu. Guests loved being able to give $50 toward something meaningful instead of guessing at homewares.', 'Sophie & James', 'Sydney, NSW', 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=200&q=80'],
                ['Setting up our registry took about ten minutes. The page looked beautiful and our guests kept saying how easy it was to use. Absolutely recommend.', 'Priya & Marcus', 'Melbourne, VIC', 'https://images.unsplash.com/photo-1529634597503-139d3726fed5?w=200&q=80'],
                ['We didn\'t need another set of plates — we needed help with a house deposit. Contribu let us ask for what we actually needed without it feeling awkward.', 'Tom & Anh', 'Brisbane, QLD', 'https://images.unsplash.com/photo-1544078751-58fee2d8a03b?w=200&q=80'],
            ] as [$quote, $name, $loc, $img])
                <div class="bg-sage-800/50 rounded-xl p-8 reveal">
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sage-100 text-sm leading-relaxed mb-6">{{ $quote }}</p>
                    <div class="flex items-center gap-3">
                        <img src="{{ $img }}" alt="{{ $name }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <div class="text-white font-semibold text-sm">{{ $name }}</div>
                            <div class="text-sage-400 text-xs">{{ $loc }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-sage-900 mb-4">Ready to start your registry?</h2>
        <p class="text-slate-500 text-lg mb-8">Free to create. Free to share. You only pay a small fee when contributions come in.</p>
        <a href="{{ route('create-registry') }}" class="inline-flex px-8 py-4 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors text-lg">Create Your Registry — It's Free</a>
    </div>
</section>

@endsection
