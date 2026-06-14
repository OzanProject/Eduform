@php
    $brandLogoPath = \App\Models\Setting::where('key', 'brand_logo')->value('value');
@endphp
<x-layouts.app title="{{ $title ?? 'Admin EduForm' }}">
  <div class="flex min-h-screen bg-slate-50 md:pb-0 pb-20">
    <!-- Sidebar (Desktop Only) -->
    <aside class="hidden md:flex flex-col w-64 fixed inset-y-0 left-0 z-50 bg-slate-900 text-slate-300">
      <div class="px-6 py-6 border-b border-slate-800">
        <div class="flex items-center gap-2.5">
          @if($brandLogoPath)
            <img src="{{ asset('storage/' . $brandLogoPath) }}" alt="Logo" class="w-9 h-9 object-contain bg-white rounded-md p-0.5">
          @else
            <div class="w-9 h-9 rounded-md bg-blue-600 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21.42 10.922a2 2 0 0 0-.019-3.838L12.83 4.34a2 2 0 0 0-1.66 0L2.6 7.08a2 2 0 0 0 0 3.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>
            </div>
          @endif
          <div>
            <div class="font-heading font-semibold text-white text-base leading-none">{{ \App\Models\Setting::where('key', 'brand_name')->value('value') ?? 'EduForm' }}</div>
            <div class="text-[10px] uppercase tracking-[0.18em] text-slate-500 mt-1">{{ \App\Models\Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment' }}</div>
          </div>
        </div>
      </div>

      <nav class="flex-1 px-3 py-6 space-y-1">
        <div class="px-3 text-[10px] uppercase tracking-[0.18em] text-slate-500 mb-3">Menu Utama</div>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
          <span>Beranda</span>
        </a>
        
        <a href="{{ route('admin.forms.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm transition-colors {{ request()->routeIs('admin.forms.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
          <span>Formulir</span>
        </a>

        <a href="{{ route('admin.responses') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm transition-colors {{ request()->routeIs('admin.responses') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
          <span>Respon</span>
        </a>

        <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm transition-colors {{ request()->routeIs('admin.settings') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
          <span>Pengaturan</span>
        </a>
      </nav>

      <div class="px-3 py-4 border-t border-slate-800">
        <div class="flex items-center gap-3 px-3 py-2 rounded-md">
          <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-medium uppercase">
            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
          </div>
          <div class="flex-1 min-w-0">
            <div class="text-sm text-slate-200 truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
            <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main column -->
    <div class="flex-1 flex flex-col min-w-0 md:ml-64">
      <!-- Header -->
      <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30 shadow-sm md:shadow-none">
        <div class="flex items-center gap-3 min-w-0">
          <div class="min-w-0">
            <h1 class="font-heading text-lg sm:text-xl font-bold text-slate-900 truncate">
              {{ $title ?? 'Judul Halaman' }}
            </h1>
            @if(isset($subtitle))
              <p class="text-[11px] sm:text-xs font-medium text-slate-500 truncate uppercase tracking-wider">{{ $subtitle }}</p>
            @endif
          </div>
        </div>

        <div class="flex items-center gap-2">
          <form action="{{ route('logout') }}" method="POST" class="inline-block md:hidden">
            @csrf
            <button
              type="submit"
              class="w-8 h-8 flex items-center justify-center text-slate-500 hover:text-red-600 rounded-full hover:bg-red-50 transition-colors"
              title="Keluar"
            >
              <!-- LogOut Icon Mobile -->
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
            </button>
          </form>
          <form action="{{ route('logout') }}" method="POST" class="hidden md:inline-block">
            @csrf
            <button
              type="submit"
              class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2 rounded-md hover:bg-slate-100 transition-colors"
              title="Keluar"
            >
              <!-- LogOut Icon Desktop -->
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
              <span>Keluar</span>
            </button>
          </form>
        </div>
      </header>

      <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0">
        {{ $slot }}
      </main>

      <!-- Desktop Footer -->
      <footer class="hidden md:block bg-white border-t border-slate-200 py-4 px-4 sm:px-8 mt-auto">
        <div class="flex items-center justify-between">
          <div class="text-sm text-slate-500">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::where('key', 'brand_name')->value('value') ?? 'EduForm' }} {{ \App\Models\Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment' }}. All rights reserved.
          </div>
          <div class="text-xs font-medium text-slate-400 bg-slate-100 px-2 py-1 rounded">
            v1.0.0
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Mobile Bottom Navigation Bar -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 pb-safe">
    <div class="flex items-center justify-around h-16 px-2">
      <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center w-16 h-full {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
        <div class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-50' : '' }} p-1.5 rounded-full mb-1 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ request()->routeIs('admin.dashboard') ? '2.5' : '1.75' }}" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
        </div>
        <span class="text-[10px] font-medium leading-none">Beranda</span>
      </a>
      
      <a href="{{ route('admin.forms.index') }}" class="flex flex-col items-center justify-center w-16 h-full {{ request()->routeIs('admin.forms.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
        <div class="{{ request()->routeIs('admin.forms.*') ? 'bg-blue-50' : '' }} p-1.5 rounded-full mb-1 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ request()->routeIs('admin.forms.*') ? '2.5' : '1.75' }}" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
        </div>
        <span class="text-[10px] font-medium leading-none">Formulir</span>
      </a>

      <a href="{{ route('admin.responses') }}" class="flex flex-col items-center justify-center w-16 h-full {{ request()->routeIs('admin.responses') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
        <div class="{{ request()->routeIs('admin.responses') ? 'bg-blue-50' : '' }} p-1.5 rounded-full mb-1 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ request()->routeIs('admin.responses') ? '2.5' : '1.75' }}" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
        </div>
        <span class="text-[10px] font-medium leading-none">Respon</span>
      </a>

      <a href="{{ route('admin.settings') }}" class="flex flex-col items-center justify-center w-16 h-full {{ request()->routeIs('admin.settings') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
        <div class="{{ request()->routeIs('admin.settings') ? 'bg-blue-50' : '' }} p-1.5 rounded-full mb-1 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ request()->routeIs('admin.settings') ? '2.5' : '1.75' }}" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <span class="text-[10px] font-medium leading-none">Pengaturan</span>
      </a>
    </div>
    <!-- Safe area padding for iPhone X/newer -->
    <div class="h-safe"></div>
  </nav>

  @if(session()->has('success'))
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.Toast) {
            window.Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        }
    });
  </script>
  @endif
</x-layouts.app>
