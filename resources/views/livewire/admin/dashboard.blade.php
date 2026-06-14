<x-slot:subtitle>Ringkasan platform EduForm Assessment</x-slot:subtitle>

<div class="space-y-6 sm:space-y-8">
  <!-- Actions -->
  <div class="flex justify-end">
    <a
      href="{{ route('admin.forms.create') }}"
      class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors shadow-sm whitespace-nowrap"
    >
      <!-- Plus Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
      <span class="hidden sm:inline">Formulir Baru</span>
      <span class="sm:hidden">Buat Baru</span>
    </a>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
    <!-- Stat Total Forms -->
    <div class="bg-white border border-slate-200 rounded-lg p-6">
      <div class="flex items-start justify-between">
        <div>
          <div class="text-[10px] uppercase tracking-[0.18em] font-semibold text-slate-500">Total Formulir</div>
          <div class="font-heading text-4xl font-semibold text-slate-900 mt-3 tracking-tight">{{ $stats['total_forms'] }}</div>
        </div>
        <div class="w-10 h-10 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center">
          <!-- FileText Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
        </div>
      </div>
    </div>

    <!-- Stat Active Forms -->
    <div class="bg-white border border-slate-200 rounded-lg p-6">
      <div class="flex items-start justify-between">
        <div>
          <div class="text-[10px] uppercase tracking-[0.18em] font-semibold text-slate-500">Formulir Aktif</div>
          <div class="font-heading text-4xl font-semibold text-slate-900 mt-3 tracking-tight">{{ $stats['active_forms'] }}</div>
        </div>
        <div class="w-10 h-10 rounded-md bg-green-50 text-green-600 flex items-center justify-center">
          <!-- CheckCircle2 Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
        </div>
      </div>
    </div>

    <!-- Stat Total Responses -->
    <div class="bg-white border border-slate-200 rounded-lg p-6">
      <div class="flex items-start justify-between">
        <div>
          <div class="text-[10px] uppercase tracking-[0.18em] font-semibold text-slate-500">Total Respon</div>
          <div class="font-heading text-4xl font-semibold text-slate-900 mt-3 tracking-tight">{{ $stats['total_responses'] }}</div>
        </div>
        <div class="w-10 h-10 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center">
          <!-- Inbox Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
        </div>
      </div>
    </div>
  </div>

  <section class="bg-white border border-slate-200 rounded-lg">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
      <div>
        <h2 class="font-heading text-lg font-semibold text-slate-900">Formulir Terbaru</h2>
        <p class="text-xs text-slate-500 mt-0.5">5 formulir yang baru dibuat</p>
      </div>
      <a
        href="{{ route('admin.dashboard') }}"
        class="text-sm text-blue-600 hover:text-blue-700 inline-flex items-center gap-1"
      >
        Lihat semua
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
      </a>
    </div>

    @if($stats['recent_forms']->isEmpty())
      <div class="px-6 py-16 text-center">
        <div class="w-12 h-12 mx-auto rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
          <!-- FileBarChart Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 18v-4"/><path d="M14 18v-2"/><path d="M18 18v-6"/></svg>
        </div>
        <div class="font-heading text-lg font-medium text-slate-900">Belum ada formulir</div>
        <p class="text-sm text-slate-500 mt-1">Buat formulir pertama untuk memulai asesmen.</p>
        <a
          href="{{ route('admin.forms.create') }}"
          class="inline-flex items-center gap-1.5 mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md px-4 py-2"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg> 
          Buat Formulir
        </a>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-slate-200 bg-slate-50">
              <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Judul</th>
              <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Status</th>
              <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Respon</th>
              <th class="text-right px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stats['recent_forms'] as $f)
              <tr class="border-b border-slate-100 last:border-b-0 hover:bg-slate-50/60">
                <td class="px-6 py-4">
                  <div class="font-medium text-slate-900">{{ $f->title }}</div>
                  <div class="text-xs text-slate-500 font-mono mt-0.5">/{{ $f->slug }}</div>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium {{ $f->is_active ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $f->is_active ? 'bg-blue-500' : 'bg-slate-400' }}"></span>
                    {{ $f->is_active ? 'Aktif' : 'Ditutup' }}
                  </span>
                </td>
                <td class="px-6 py-4 text-slate-700">{{ $f->responses_count }}</td>
                <td class="px-6 py-4 text-right">
                  <a href="{{ route('admin.forms.builder', $f->id) }}" class="text-sm text-blue-600 hover:text-blue-700">Buka</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>
</div>
