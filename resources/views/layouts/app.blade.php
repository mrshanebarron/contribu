<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Contribu') — Contribu | Group-Funded Gift Registry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#f6f7f4',
                            100: '#e8ebe3',
                            200: '#d3d9c9',
                            300: '#b4bfa5',
                            400: '#95a37f',
                            500: '#798963',
                            600: '#5e6d4d',
                            700: '#4a563e',
                            800: '#3d4634',
                            900: '#343c2e',
                        },
                        cream: {
                            50: '#fefdfb',
                            100: '#fdf8f0',
                            200: '#faf0de',
                            300: '#f5e3c4',
                        },
                        blush: {
                            50: '#fef7f5',
                            100: '#fde8e2',
                            200: '#fcd2c8',
                            300: '#f8b0a0',
                            400: '#f28b74',
                        },
                        gold: {
                            400: '#d4a853',
                            500: '#c49b3d',
                            600: '#a8832f',
                        }
                    },
                    fontFamily: {
                        serif: ['Cormorant Garamond', 'Georgia', 'serif'],
                        sans: ['Outfit', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
    @stack('styles')
</head>
<body class="bg-cream-50 font-sans text-slate-800 antialiased">

{{-- Navigation --}}
<nav x-data="{ scrolled: false, open: false }" @scroll.window="scrolled = window.scrollY > 40"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg class="w-7 h-7 text-sage-600" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 4C16 4 8 8 8 16C8 20.4 11.6 24 16 24C20.4 24 24 20.4 24 16C24 8 16 4 16 4Z" fill="currentColor" opacity="0.2"/>
                    <path d="M16 4C16 4 8 8 8 16C8 20.4 11.6 24 16 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M16 4C16 4 24 8 24 16C24 20.4 20.4 24 16 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M16 4V24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="2 3"/>
                    <circle cx="16" cy="28" r="1.5" fill="currentColor"/>
                </svg>
                <span class="font-serif text-2xl font-bold tracking-tight" :class="scrolled ? 'text-sage-800' : 'text-sage-800'">contribu</span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('how-it-works') }}" class="text-sm font-medium text-slate-600 hover:text-sage-700 transition-colors">How It Works</a>
                <a href="{{ route('wedding', 'emma-and-liam') }}" class="text-sm font-medium text-slate-600 hover:text-sage-700 transition-colors">Demo Registry</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium text-slate-600 hover:text-sage-700 transition-colors">Contact</a>
                <a href="{{ route('create-registry') }}" class="px-5 py-2.5 bg-sage-600 text-white text-sm font-semibold rounded-lg hover:bg-sage-700 transition-colors">Create Registry</a>
            </div>

            {{-- Mobile Toggle --}}
            <button @click="open = !open" class="md:hidden p-2 text-slate-600">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak x-transition class="md:hidden pb-6 space-y-3">
            <a href="{{ route('how-it-works') }}" class="block px-3 py-2 text-sm font-medium text-slate-600 hover:text-sage-700 rounded-lg hover:bg-sage-50">How It Works</a>
            <a href="{{ route('wedding', 'emma-and-liam') }}" class="block px-3 py-2 text-sm font-medium text-slate-600 hover:text-sage-700 rounded-lg hover:bg-sage-50">Demo Registry</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-sm font-medium text-slate-600 hover:text-sage-700 rounded-lg hover:bg-sage-50">Contact</a>
            <a href="{{ route('create-registry') }}" class="block px-3 py-2 bg-sage-600 text-white text-sm font-semibold rounded-lg text-center">Create Registry</a>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-sage-900 text-sage-200 py-16 px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-6 h-6 text-sage-400" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 4C16 4 8 8 8 16C8 20.4 11.6 24 16 24C20.4 24 24 20.4 24 16C24 8 16 4 16 4Z" fill="currentColor" opacity="0.2"/>
                        <path d="M16 4C16 4 8 8 8 16C8 20.4 11.6 24 16 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M16 4C16 4 24 8 24 16C24 20.4 20.4 24 16 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="16" cy="28" r="1.5" fill="currentColor"/>
                    </svg>
                    <span class="font-serif text-xl font-bold text-white">contribu</span>
                </div>
                <p class="text-sage-300 text-sm leading-relaxed max-w-sm">Australia's group-funded wedding gift registry. Create your wishlist, share with loved ones, and let everyone contribute to the gifts that matter most.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white text-sm mb-4">Platform</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('how-it-works') }}" class="text-sage-300 hover:text-white transition-colors">How It Works</a></li>
                    <li><a href="{{ route('create-registry') }}" class="text-sage-300 hover:text-white transition-colors">Create Registry</a></li>
                    <li><a href="{{ route('wedding', 'emma-and-liam') }}" class="text-sage-300 hover:text-white transition-colors">Demo Registry</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white text-sm mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('contact') }}" class="text-sage-300 hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-sage-300 hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-sage-300 hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-sage-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sage-400 text-xs">&copy; {{ date('Y') }} Contribu. Made with love in Australia.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-sage-400 hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                <a href="#" class="text-sage-400 hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="text-sage-400 hover:text-white transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12.017 24c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641 0 12.017 0z"/></svg></a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));
    });
</script>
@stack('scripts')
</body>
</html>
