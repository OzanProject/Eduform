<x-slot:subtitle>
  Slug: /{{ $form->slug }} • {{ $form->is_active ? 'Status: Aktif' : 'Status: Ditutup' }}
</x-slot:subtitle>

<div>
  <!-- Tab Navigation & Actions -->
  <div class="border-b border-slate-200 mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
    <nav class="-mb-px flex gap-6">
      <a
        href="{{ route('admin.forms.builder', $form->id) }}"
        class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
      >
        Pertanyaan
      </a>
      <a
        href="{{ route('admin.forms.responses', $form->id) }}"
        class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
      >
        Respon
        <span class="ml-2 bg-blue-100 text-blue-700 py-0.5 px-2 rounded-full text-xs">{{ $responses->total() }}</span>
      </a>
    </nav>
    <div class="pb-2 flex items-center gap-1.5 sm:gap-3 self-end sm:self-auto">
      <a
        href="{{ route('admin.forms.export.excel', $form->id) }}"
        title="Export Excel"
        class="inline-flex items-center justify-center w-8 h-8 sm:w-auto sm:h-auto gap-1.5 text-sm bg-green-600 hover:bg-green-700 text-white font-medium rounded-md sm:rounded-lg sm:px-4 sm:py-2.5 transition-colors disabled:opacity-50 shadow-sm"
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
        <span class="hidden sm:inline">Export Excel</span>
      </a>
      <a
        href="{{ route('admin.forms.export.pdf', $form->id) }}"
        title="Export PDF"
        class="inline-flex items-center justify-center w-8 h-8 sm:w-auto sm:h-auto gap-1.5 text-sm bg-red-600 hover:bg-red-700 text-white font-medium rounded-md sm:rounded-lg sm:px-4 sm:py-2.5 transition-colors disabled:opacity-50 shadow-sm"
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        <span class="hidden sm:inline">Export PDF</span>
      </a>
      <a
        href="/f/{{ $form->slug }}"
        target="_blank"
        title="Preview"
        class="hidden sm:inline-flex items-center gap-1.5 text-sm text-slate-700 border border-slate-300 hover:bg-slate-50 rounded-lg px-4 py-2.5 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
        Preview
      </a>
    </div>
  </div>

  @if($responses->isEmpty() && empty($search))
    <div class="bg-white border border-slate-200 rounded-lg py-20 px-6 text-center">
      <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
      </div>
      <h3 class="font-heading text-lg font-semibold text-slate-900 mb-1">Menunggu Respon</h3>
      <p class="text-sm text-slate-500 max-w-sm mx-auto">
        Belum ada responden yang mengisi formulir ini. Bagikan link formulir Anda untuk mulai mengumpulkan data.
      </p>
      <div class="mt-6 flex justify-center">
        <button 
          onclick="navigator.clipboard.writeText('{{ url('/f/'.$form->slug) }}'); alert('Link disalin!')"
          class="inline-flex items-center gap-2 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-md px-4 py-2 text-sm shadow-sm transition-colors"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
          Salin Link Publik
        </button>
      </div>
    </div>
  @else
    <div class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
      <!-- Search & Controls -->
      <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-2">
          <span class="text-sm text-slate-500">Tampilkan</span>
          <select wire:model.live="perPage" class="border border-slate-300 rounded-md text-sm py-1.5 pl-3 pr-8 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span class="text-sm text-slate-500">data</span>
        </div>
        
        <div class="relative w-full sm:w-64">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Cari respon..."
            class="w-full pl-9 pr-3 py-2 border border-slate-300 rounded-md text-sm outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white shadow-sm"
          />
        </div>
      </div>

      @if($responses->isEmpty())
        <div class="px-6 py-12 text-center text-slate-500 text-sm">
          Tidak ditemukan respon dengan kata kunci "{{ $search }}"
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left">
            <thead class="bg-slate-50/80 border-b border-slate-200 text-xs uppercase tracking-wider font-semibold text-slate-500">
              <tr>
                <th class="px-6 py-4 whitespace-nowrap">Waktu Submit</th>
                @foreach($form->questions as $q)
                  <th class="px-6 py-4 whitespace-nowrap max-w-[200px] truncate" title="{{ $q->text }}">
                    {{ $q->text }}
                  </th>
                @endforeach
                <th class="px-6 py-4 text-right whitespace-nowrap">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @foreach($responses as $res)
                <tr class="hover:bg-slate-50/50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-mono text-xs">
                    {{ $res->created_at->format('d M Y, H:i') }}
                  </td>
                  
                  @foreach($form->questions as $q)
                    @php
                      $ans = $res->answers->firstWhere('question_id', $q->id);
                      $val = $ans ? $ans->value : '-';
                    @endphp
                    <td class="px-6 py-4 min-w-[150px] max-w-[300px]">
                      @if($q->type === 'file_upload' && $val !== '-')
                        <a href="{{ Storage::url($val) }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 hover:underline bg-blue-50 px-2.5 py-1 rounded-md text-xs font-medium">
                          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                          Lihat File
                        </a>
                      @else
                        <div class="truncate text-slate-700" title="{{ $val }}">{{ $val }}</div>
                      @endif
                    </td>
                  @endforeach
                  
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <button
                      wire:click="confirmDelete({{ $res->id }})"
                      class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                      title="Hapus Respon"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        @if($responses->hasPages())
          <div class="px-6 py-4 border-t border-slate-200">
            {{ $responses->links(data: ['scrollTo' => false]) }}
          </div>
        @endif
      @endif
    </div>
  @endif

  <!-- Delete Modal -->
  @if($deleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 p-4">
      <div class="bg-white rounded-xl border border-slate-200 max-w-sm w-full p-6 shadow-xl">
        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
        </div>
        <h3 class="font-heading text-lg font-semibold text-slate-900">Hapus respon?</h3>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
          Tindakan ini akan menghapus data respon secara permanen, termasuk file yang diunggah responden ini.
        </p>
        <div class="flex items-center gap-3 mt-6">
          <button
            wire:click="cancelDelete"
            class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 rounded-lg transition-colors"
          >
            Batal
          </button>
          <button
            wire:click="deleteResponse"
            class="flex-1 px-4 py-2.5 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors inline-flex justify-center items-center gap-2"
          >
            <span wire:loading.remove wire:target="deleteResponse">Hapus</span>
            <span wire:loading wire:target="deleteResponse">Menghapus...</span>
          </button>
        </div>
      </div>
    </div>
  @endif
</div>
