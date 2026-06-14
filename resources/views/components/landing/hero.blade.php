<!-- Main Hero Section -->
<main class="relative z-10 pt-32 pb-16 sm:pt-40 sm:pb-24 lg:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex flex-col items-center text-center min-h-[90vh] justify-center">
    
    <!-- Badge -->
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-xs sm:text-sm font-semibold mb-8 shadow-sm">
        <span class="flex h-2 w-2 relative">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
        </span>
        Aplikasi Pembuat Formulir Modern
    </div>

    <!-- Headline -->
    <h1 class="font-heading text-5xl sm:text-6xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6 max-w-4xl">
        Buat Formulir Online <br class="hidden sm:block">
        Lebih <span class="bg-gradient-to-r from-blue-600 via-indigo-500 to-violet-600 bg-clip-text text-transparent bg-gradient-animate">Cepat & Elegan</span>
    </h1>

    <!-- Subheadline -->
    <p class="text-lg sm:text-xl text-slate-500 mb-10 max-w-2xl leading-relaxed">
        Platform terbaik untuk mengumpulkan data, survei, dan evaluasi. Responsif, interaktif, dan dirancang khusus untuk kenyamanan Anda dan responden Anda di layar apa pun.
    </p>

    <!-- CTA Buttons -->
    <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-base font-semibold px-8 py-4 rounded-full transition-all shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1">
                Masuk ke Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        @else
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-base font-semibold px-8 py-4 rounded-full transition-all shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1">
                    Mulai Buat Formulir
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            @endif
            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 text-base font-semibold px-8 py-4 rounded-full transition-all shadow-sm hover:shadow-md hover:-translate-y-1">
                Login ke Akun
            </a>
        @endauth
    </div>

    <!-- Dashboard Mockup/Visual (Abstract) -->
    <div class="mt-20 w-full max-w-5xl relative" style="perspective: 1000px;">
        <!-- Fade overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 to-transparent z-10 top-[60%]"></div>
        
        <div class="bg-white p-2 rounded-2xl sm:rounded-[2rem] shadow-2xl border border-slate-200/60 transform rotate-x-12 translate-y-8 hover:rotate-x-0 hover:translate-y-0 transition-all duration-700 ease-out origin-bottom">
            <div class="bg-slate-50 rounded-xl sm:rounded-[1.5rem] border border-slate-100 overflow-hidden flex flex-col h-[350px] sm:h-[450px]">
                <!-- Mockup Header -->
                <div class="h-12 border-b border-slate-200/60 bg-white flex items-center px-4 justify-between">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="h-6 w-32 bg-slate-100 rounded-md"></div>
                    <div class="h-6 w-6 rounded-full bg-slate-200"></div>
                </div>
                <!-- Mockup Body (Dashboard Layout) -->
                <div class="flex-1 flex overflow-hidden">
                    <!-- Sidebar -->
                    <div class="w-48 border-r border-slate-200/60 bg-white hidden sm:flex flex-col p-4 gap-3">
                        <div class="h-8 bg-blue-50 rounded-md"></div>
                        <div class="h-8 bg-slate-50 rounded-md"></div>
                        <div class="h-8 bg-slate-50 rounded-md"></div>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 p-6 flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div class="h-8 w-40 bg-slate-200 rounded-lg"></div>
                            <div class="h-8 w-24 bg-blue-600/90 rounded-lg shadow-sm"></div>
                        </div>
                        <!-- Cards -->
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="h-28 bg-white border border-slate-100 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02)] p-5 flex flex-col justify-end">
                                <div class="h-4 w-1/2 bg-slate-100 rounded mb-3"></div>
                                <div class="h-8 w-1/3 bg-slate-200 rounded"></div>
                            </div>
                            <div class="h-28 bg-white border border-slate-100 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02)] p-5 flex flex-col justify-end">
                                <div class="h-4 w-1/2 bg-slate-100 rounded mb-3"></div>
                                <div class="h-8 w-1/3 bg-slate-200 rounded"></div>
                            </div>
                            <div class="h-28 bg-white border border-slate-100 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02)] p-5 flex-col justify-end hidden lg:flex">
                                <div class="h-4 w-1/2 bg-slate-100 rounded mb-3"></div>
                                <div class="h-8 w-1/3 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="flex-1 bg-white border border-slate-100 rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02)]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
