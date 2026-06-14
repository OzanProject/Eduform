@props(['brandName' => 'EduForm', 'brandLogoPath' => null])
<!-- Header / Navbar -->
<header class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-white/70 backdrop-blur-md border-b border-white/20 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2.5 group">
            @if($brandLogoPath)
                <img src="{{ asset('storage/' . $brandLogoPath) }}" alt="Logo" class="w-10 h-10 object-contain group-hover:scale-105 transition-all duration-300">
            @else
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-violet-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-all duration-300 group-hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                </div>
            @endif
            <span class="font-heading font-bold text-xl tracking-tight text-slate-900">{{ $brandName }}<span class="text-blue-600">.</span></span>
        </a>

        <!-- Navigation Actions -->
        <div class="flex items-center gap-3 sm:gap-4">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="font-medium text-sm sm:text-base text-slate-600 hover:text-blue-600 transition-colors hidden sm:block mr-2">Dashboard</a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium px-5 py-2.5 rounded-full transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Buka Aplikasi
                </a>
            @else
                <a href="{{ route('login') }}" class="font-medium text-sm sm:text-base text-slate-600 hover:text-slate-900 transition-colors px-2 py-1">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-full transition-all shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/40 hover:-translate-y-0.5">
                        Daftar Gratis
                    </a>
                @endif
            @endauth
        </div>
    </div>
</header>
