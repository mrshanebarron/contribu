@extends('layouts.app')
@section('title', 'How It Works')
@section('content')

<section class="bg-sage-900 pt-28 pb-16 lg:pt-36 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <p class="text-sage-400 text-xs font-semibold uppercase tracking-widest mb-3">How It Works</p>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-white mb-4">Simple for you. Easy for your guests.</h1>
        <p class="text-sage-200 text-lg max-w-xl mx-auto">No apps to download, no accounts for guests to create. Just a beautiful link and a clear path to giving.</p>
    </div>
</section>

{{-- Steps --}}
<section class="py-24 px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        @foreach([
            [
                'step' => '01',
                'title' => 'Create your wedding page',
                'desc' => 'Sign up and build your personalized wedding page in minutes. Add your names, wedding date, venue, your story, and a beautiful cover photo. This becomes the hub for your entire gift registry.',
                'details' => ['Personalized URL (contribu.com.au/your-names)', 'Your love story', 'Wedding date countdown', 'Venue details with map', 'RSVP system built in'],
                'image' => 'https://images.unsplash.com/photo-1513623935135-c896b59073c1?w=700&q=80',
                'flip' => false,
            ],
            [
                'step' => '02',
                'title' => 'Build your gift wishlist',
                'desc' => 'Add the gifts you actually want — from honeymoon funds and house deposits to kitchen appliances and experience vouchers. Set a goal amount for each, upload a photo, and write a short description. Add as many as you like.',
                'details' => ['Unlimited gift items', 'Custom images and descriptions', 'Flexible goal amounts', 'Priority levels', 'Edit anytime'],
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=700&q=80',
                'flip' => true,
            ],
            [
                'step' => '03',
                'title' => 'Share with your guests',
                'desc' => 'Send your unique Contribu link with your wedding invitations, via email, or on social media. Guests can browse your registry without creating an account — just click, choose, and contribute.',
                'details' => ['One shareable link', 'No guest accounts required', 'Works on any device', 'Easy to include in invitations', 'QR code available'],
                'image' => 'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=700&q=80',
                'flip' => false,
            ],
            [
                'step' => '04',
                'title' => 'Collect contributions securely',
                'desc' => 'Watch your gifts get funded in real time. Each guest can contribute any amount toward any gift — making big-ticket items achievable. Payments are processed securely through Stripe, and funds are deposited directly to your bank account.',
                'details' => ['Real-time progress bars', 'Secure Stripe payments', 'Instant email receipts', 'Personal messages from guests', 'Direct bank deposits'],
                'image' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=700&q=80',
                'flip' => true,
            ],
        ] as $step)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20 last:mb-0 reveal">
                <div class="{{ $step['flip'] ? 'lg:order-2' : '' }}">
                    <span class="font-serif text-5xl font-bold text-sage-200">{{ $step['step'] }}</span>
                    <h2 class="font-serif text-3xl font-bold text-sage-900 mt-2 mb-4">{{ $step['title'] }}</h2>
                    <p class="text-slate-500 leading-relaxed mb-6">{{ $step['desc'] }}</p>
                    <ul class="space-y-2">
                        @foreach($step['details'] as $detail)
                            <li class="flex items-center gap-3 text-sm text-slate-600">
                                <svg class="w-4 h-4 text-sage-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                {{ $detail }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="{{ $step['flip'] ? 'lg:order-1' : '' }}">
                    <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}" class="rounded-xl w-full aspect-[4/3] object-cover shadow-lg">
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- FAQ --}}
<section class="py-24 px-6 lg:px-8 bg-sage-50/50">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12 reveal">
            <h2 class="font-serif text-3xl font-bold text-sage-900">Common questions</h2>
        </div>
        <div class="space-y-4" x-data="{ open: null }">
            @foreach([
                ['Is it really free to create a registry?', 'Yes. Creating your page, adding gifts, and sharing your link is completely free. We only charge a small processing fee (2.9% + 30c) on contributions — that\'s it. No monthly fees, no hidden charges.'],
                ['Do my guests need to create an account?', 'No. Guests can browse your registry and make contributions without signing up for anything. They just need your link and a payment method.'],
                ['How do I receive the money?', 'Contributions are processed through Stripe and deposited directly into your nominated Australian bank account. Payouts typically arrive within 2-3 business days.'],
                ['Can guests contribute any amount?', 'Yes. There\'s no minimum or maximum contribution (beyond a $5 minimum per transaction). Guests can give whatever feels right to them.'],
                ['Can I add non-physical gifts?', 'Absolutely. Honeymoon funds, house deposits, experience vouchers, charity donations — anything you can describe and set a goal for, you can add to your registry.'],
                ['What happens if a gift gets overfunded?', 'Extra funds are deposited to your account just like any other contribution. You can use them however you choose.'],
            ] as $i => [$q, $a])
                <div class="bg-white border border-sage-200 rounded-xl overflow-hidden reveal">
                    <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="flex items-center justify-between w-full p-5 text-left">
                        <span class="font-semibold text-sage-900 text-sm pr-4">{{ $q }}</span>
                        <svg class="w-5 h-5 text-sage-400 shrink-0 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </button>
                    <div x-show="open === {{ $i }}" x-collapse x-cloak class="px-5 pb-5">
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $a }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 px-6 lg:px-8 bg-sage-600">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 class="font-serif text-3xl font-bold text-white mb-4">Start your registry in minutes</h2>
        <p class="text-sage-100 mb-8">Join over 1,200 Australian couples who chose Contribu for their wedding.</p>
        <a href="{{ route('create-registry') }}" class="px-8 py-3.5 bg-white text-sage-700 font-bold rounded-lg hover:bg-cream-100 transition-colors">Create Your Registry</a>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush
