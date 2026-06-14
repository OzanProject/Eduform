@php
    $brandLogoPath = \App\Models\Setting::where('key', 'brand_logo')->value('value');
    $brandName = \App\Models\Setting::where('key', 'brand_name')->value('value') ?? 'EduForm';
    $brandSubtitle = \App\Models\Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment';
    $fullBrandName = trim($brandName . ' ' . $brandSubtitle);
@endphp

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 bg-slate-50">
  <!-- Left form -->
  <div class="flex flex-col px-6 sm:px-12 py-8 lg:py-16 bg-white relative z-10 shadow-[20px_0_40px_-15px_rgba(0,0,0,0.05)]">
    <!-- Header/Logo -->
    <div class="flex items-center gap-3">
      @if($brandLogoPath)
        <img src="{{ asset('storage/' . $brandLogoPath) }}" alt="Logo" class="w-10 h-10 object-contain">
      @else
        <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center shadow-md shadow-blue-600/20">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21.42 10.922a2 2 0 0 0-.019-3.838L12.83 4.34a2 2 0 0 0-1.66 0L2.6 7.08a2 2 0 0 0 0 3.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>
        </div>
      @endif
      <div class="flex flex-col">
        <div class="font-heading font-semibold text-slate-900 text-lg leading-none">{{ $brandName }}</div>
        <div class="text-[10px] uppercase tracking-[0.2em] text-slate-500 mt-1 font-medium">{{ $brandSubtitle }}</div>
      </div>
    </div>

    <!-- Main Content Form -->
    <div class="flex-1 flex items-center justify-center">
      <div class="w-full max-w-md mx-auto">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold tracking-wider uppercase mb-6 border border-blue-100">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
          Akses Administrator
        </div>
        
        <h1 class="font-heading text-4xl sm:text-5xl font-bold text-slate-900 tracking-tight leading-tight">
          Selamat datang <br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">kembali.</span>
        </h1>
        <p class="text-slate-500 mt-4 leading-relaxed text-lg">
          Masuk ke dasbor untuk mengelola formulir, respons, dan pengaturan sistem Anda.
        </p>

        <form wire:submit="login" class="mt-10 space-y-6" data-testid="login-form">
          <!-- Input Group: Email -->
          <div class="space-y-1.5">
            <label class="block text-sm font-medium text-slate-700">Alamat Email</label>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              </div>
              <input
                wire:model="email"
                type="email"
                required
                placeholder="admin@example.com"
                class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-xl bg-slate-50/50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all shadow-sm"
              />
            </div>
          </div>
          
          <!-- Input Group: Password -->
          <div class="space-y-1.5">
            <div class="flex items-center justify-between">
              <label class="block text-sm font-medium text-slate-700">Password</label>
              <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline underline-offset-4 transition-all">Lupa password?</a>
            </div>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </div>
              <input
                wire:model="password"
                type="password"
                required
                placeholder="••••••••"
                class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-xl bg-slate-50/50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all shadow-sm"
              />
            </div>
          </div>

          @error('email')
            <div data-testid="login-error" class="flex items-start gap-3 p-4 bg-red-50 text-red-700 rounded-xl border border-red-100/50">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              <span class="text-sm">{{ $message }}</span>
            </div>
          @enderror

          <button
            type="submit"
            wire:loading.attr="disabled"
            class="group relative w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl px-4 py-3.5 transition-all duration-300 disabled:opacity-80 disabled:cursor-wait overflow-hidden shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 focus:ring-4 focus:ring-blue-500/30 outline-none"
          >
            <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
            <span wire:loading.remove wire:target="login" class="relative z-10 text-base">Masuk ke Dasbor</span>
            <span wire:loading wire:target="login" class="relative z-10 text-base">Memproses...</span>
            <svg wire:loading.remove wire:target="login" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="relative z-10 transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            <svg wire:loading wire:target="login" class="animate-spin relative z-10" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
          </button>
        </form>
      </div>
    </div>

    <div class="text-sm font-medium text-slate-400 text-center lg:text-left mt-8">
      &copy; {{ date('Y') }} {{ $fullBrandName }}. All rights reserved.
    </div>
  </div>

  <!-- Right hero / Visuals -->
  <div class="hidden lg:flex relative bg-slate-900 overflow-hidden group">
    <!-- Background Image -->
    <img
      src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop"
      alt="Office Background"
      class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay group-hover:scale-105 transition-transform duration-[10s]"
    />
    <!-- Dynamic Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/80 to-slate-900"></div>
    
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-500/10 blur-3xl"></div>

    <div class="relative z-10 p-16 flex flex-col justify-center h-full text-white max-w-2xl">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-200 text-xs font-semibold tracking-widest uppercase mb-8 w-max">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Sistem Terpadu
      </div>
      <h2 class="font-heading text-4xl xl:text-5xl font-bold leading-[1.15] mb-6">
        Kelola asesmen lebih cerdas, bukan lebih keras.
      </h2>
      <p class="text-slate-300 text-lg leading-relaxed max-w-lg">
        Platform form builder terpusat dengan kemampuan dinamis. Buat pertanyaan, kumpulkan respons, dan ekspor data dalam hitungan detik—semuanya menggunakan identitas instansi Anda sendiri.
      </p>
      
      <!-- Feature highlights -->
      <div class="mt-12 grid grid-cols-2 gap-6">
        <div class="flex flex-col gap-2">
          <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center text-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
          </div>
          <div class="font-semibold text-white">White-Label Form</div>
          <div class="text-sm text-slate-400">Branding instansi Anda.</div>
        </div>
        <div class="flex flex-col gap-2">
          <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
          </div>
          <div class="font-semibold text-white">Data Real-Time</div>
          <div class="text-sm text-slate-400">Export & analisis instan.</div>
        </div>
      </div>
    </div>
  </div>
</div>
