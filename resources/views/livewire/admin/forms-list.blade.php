<x-slot:subtitle>Kelola semua formulir dan asesmen Anda</x-slot:subtitle>

<div>
  <div class="mb-6 flex justify-end">
    <a
      href="{{ route('admin.forms.create') }}"
      class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors shadow-sm"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
      <span class="hidden sm:inline">Buat Formulir</span>
      <span class="sm:hidden">Buat</span>
    </a>
  </div>

  <div class="bg-white border border-slate-200 rounded-lg relative">
    @if($forms->isEmpty() && empty($search))
      <div class="px-6 py-16 text-center">
        <div class="w-12 h-12 mx-auto rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 18v-4"/><path d="M14 18v-2"/><path d="M18 18v-6"/></svg>
        </div>
        <div class="font-heading text-lg font-medium text-slate-900">Belum ada formulir</div>
        <p class="text-sm text-slate-500 mt-1">Mulai buat formulir pertama Anda.</p>
        <a
          href="{{ route('admin.forms.create') }}"
          class="inline-flex items-center gap-1.5 mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md px-4 py-2"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
          Buat Formulir
        </a>
      </div>
    @else
      <div class="px-6 py-4 border-b border-slate-200">
        <div class="relative max-w-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Cari judul formulir..."
            class="w-full pl-9 pr-3 py-2 border border-slate-300 rounded-md text-sm outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
          />
        </div>
      </div>

      @if($forms->isEmpty())
        <div class="px-6 py-12 text-center text-slate-500 text-sm">
          Tidak ditemukan formulir dengan kata kunci "{{ $search }}"
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="bg-slate-50 border-b border-slate-200">
                <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Judul</th>
                <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Status</th>
                <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Pertanyaan</th>
                <th class="text-left px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Respon</th>
                <th class="text-right px-6 py-3 text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($forms as $f)
                <tr class="border-b border-slate-100 last:border-b-0 hover:bg-slate-50/60">
                  <td class="px-6 py-4">
                    <a href="{{ route('admin.forms.builder', $f->id) }}" class="font-medium text-slate-900 hover:text-blue-700">{{ $f->title }}</a>
                    <div class="text-xs text-slate-500 font-mono mt-0.5">/{{ $f->slug }}</div>
                  </td>
                  <td class="px-6 py-4">
                    <button
                      wire:click="toggleActive({{ $f->id }})"
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium transition {{ $f->is_active ? 'bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100' : 'bg-slate-100 text-slate-600 border border-slate-200 hover:bg-slate-200' }}"
                    >
                      <span class="w-1.5 h-1.5 rounded-full {{ $f->is_active ? 'bg-blue-500' : 'bg-slate-400' }}"></span>
                      {{ $f->is_active ? 'Aktif' : 'Ditutup' }}
                    </button>
                  </td>
                  <td class="px-6 py-4 text-slate-700">{{ $f->questions_count }}</td>
                  <td class="px-6 py-4">
                    <a href="{{ route('admin.forms.responses', $f->id) }}" class="text-slate-700 hover:text-blue-700 inline-flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg> 
                      {{ $f->responses_count }}
                    </a>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-1.5">
                      <a
                        href="/f/{{ $f->slug }}"
                        target="_blank"
                        class="p-2.5 text-slate-500 hover:text-blue-700 hover:bg-slate-100 rounded-lg transition-colors"
                        title="Preview"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                      </a>
                      
                      <a
                        href="{{ route('admin.forms.builder', $f->id) }}"
                        class="p-2.5 text-slate-500 hover:text-blue-700 hover:bg-slate-100 rounded-lg transition-colors"
                        title="Edit"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                      </a>
                      
                      <button
                        wire:click="$dispatch('swal:confirm', {
                          title: 'Hapus formulir?',
                          text: 'Tindakan ini akan menghapus semua pertanyaan dan respon terkait. Tidak dapat dibatalkan.',
                          action: 'delete-form',
                          params: { id: {{ $f->id }} }
                        })"
                        class="p-2.5 text-slate-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                        title="Hapus"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @if($forms->hasPages())
          <div class="px-6 py-4 border-t border-slate-200">
            {{ $forms->links(data: ['scrollTo' => false]) }}
          </div>
        @endif
      @endif
    @endif
  </div>
</div>
