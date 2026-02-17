@extends('layouts.app')
@section('title', 'Contact')
@section('content')

<section class="bg-sage-900 pt-28 pb-16 lg:pt-36 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <p class="text-sage-400 text-xs font-semibold uppercase tracking-widest mb-3">Contact</p>
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-white mb-4">Get in touch</h1>
        <p class="text-sage-200 text-lg max-w-xl mx-auto">Questions, partnerships, or just want to say hello? We'd love to hear from you.</p>
    </div>
</section>

<section class="py-20 px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            {{-- Form --}}
            <div class="lg:col-span-3 reveal">
                <div class="bg-white border border-sage-200 rounded-xl p-8">
                    <h2 class="font-serif text-xl font-bold text-sage-900 mb-6">Send us a message</h2>
                    <form class="space-y-5" onsubmit="event.preventDefault(); document.getElementById('contact-thanks').classList.remove('hidden'); this.classList.add('hidden');">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-sage-800 mb-1">Name</label>
                                <input type="text" required class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="Your name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-sage-800 mb-1">Email</label>
                                <input type="email" required class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none" placeholder="you@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-sage-800 mb-1">Subject</label>
                            <select class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none bg-white">
                                <option>General enquiry</option>
                                <option>Help with my registry</option>
                                <option>Payment question</option>
                                <option>Partnership or media</option>
                                <option>Bug report</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-sage-800 mb-1">Message</label>
                            <textarea rows="5" required class="w-full px-4 py-2.5 border border-sage-200 rounded-lg text-sm focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none resize-none" placeholder="How can we help?"></textarea>
                        </div>
                        <button type="submit" class="w-full py-3 bg-sage-600 text-white font-semibold rounded-lg hover:bg-sage-700 transition-colors">Send Message</button>
                    </form>
                    <div id="contact-thanks" class="hidden text-center py-8">
                        <svg class="w-12 h-12 text-sage-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="font-serif text-xl font-bold text-sage-900 mb-2">Message sent!</h3>
                        <p class="text-slate-500 text-sm">We'll get back to you within 24 hours.</p>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-2 reveal" style="transition-delay: 150ms">
                <div class="space-y-6">
                    <div class="bg-sage-50 border border-sage-200 rounded-xl p-6">
                        <h3 class="font-semibold text-sage-900 text-sm mb-4">Quick answers</h3>
                        <div class="space-y-4">
                            @foreach([
                                ['Email', 'hello@contribu.com.au', 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75'],
                                ['Response time', 'Within 24 hours', 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['Based in', 'Melbourne, Australia', 'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z'],
                            ] as [$label, $value, $icon])
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-sage-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                                    <div>
                                        <div class="text-slate-500 text-xs">{{ $label }}</div>
                                        <div class="text-sage-900 text-sm font-medium">{{ $value }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white border border-sage-200 rounded-xl p-6">
                        <h3 class="font-semibold text-sage-900 text-sm mb-2">For vendors & partners</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-3">Interested in listing your products or services on Contribu? We partner with Australian businesses that share our values.</p>
                        <a href="mailto:partners@contribu.com.au" class="text-sage-600 text-sm font-semibold hover:text-sage-700 transition-colors">partners@contribu.com.au &rarr;</a>
                    </div>

                    <div class="bg-cream-100 border border-cream-200 rounded-xl p-6">
                        <h3 class="font-semibold text-sage-900 text-sm mb-2">Need help right now?</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Check our <a href="{{ route('how-it-works') }}" class="text-sage-600 font-semibold hover:text-sage-700 underline">How It Works</a> page for answers to the most common questions about registries, payments, and setup.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
