<x-slot:subtitle>
  {{ $isNew ? 'Buat formulir asesmen baru' : 'Slug: /' . $slug }}
</x-slot:subtitle>

<div>
  <button id="hidden-save-btn" class="hidden" wire:click="save"></button>
  <!-- Flash Message -->
  @if (session()->has('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-md px-4 py-3 flex justify-between items-center">
      <span class="text-sm">{{ session('success') }}</span>
      <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
    </div>
  @endif

  <!-- Actions & Back Button -->
  <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <a href="{{ route('admin.forms.index') }}" class="text-sm text-slate-500 hover:text-slate-900 inline-flex items-center gap-1 w-fit">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Kembali ke daftar formulir
    </a>

    <div class="flex items-center gap-2 self-end sm:self-auto">
      @if(!$isNew)
        <a
          href="/f/{{ $slug }}"
          target="_blank"
          class="hidden sm:inline-flex items-center gap-1.5 text-sm text-slate-700 border border-slate-300 hover:bg-slate-50 rounded-lg px-4 py-2.5 transition-colors"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
          Preview
        </a>
      @endif
      <button
        onclick="document.getElementById('hidden-save-btn').click()"
        wire:loading.attr="disabled"
        wire:target="save"
        class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg px-4 py-2.5 disabled:opacity-60 transition-colors shadow-sm"
      >
        <svg wire:loading.remove wire:target="save" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        <svg wire:loading wire:target="save" class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
        <span wire:loading.remove wire:target="save">Simpan</span>
        <span wire:loading wire:target="save">Menyimpan...</span>
      </button>
    </div>
  </div>

  <!-- Tabs -->
  <div class="border-b border-slate-200 mb-6">
    <div class="flex items-center gap-1">
      <button
        wire:click="setTab('questions')"
        class="px-4 py-2.5 text-sm font-medium border-b-2 -mb-px {{ $activeTab === 'questions' ? 'border-blue-600 text-blue-700' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
      >
        Pertanyaan
      </button>
      <button
        wire:click="setTab('settings')"
        class="px-4 py-2.5 text-sm font-medium border-b-2 -mb-px {{ $activeTab === 'settings' ? 'border-blue-600 text-blue-700' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
      >
        Pengaturan Form
      </button>
    </div>
  </div>

  @if($activeTab === 'settings')
    <div class="bg-white border border-slate-200 rounded-lg p-6 max-w-2xl">
      <div class="space-y-5">
        <!-- Header Image Upload -->
        <div>
          <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Kop Surat / Banner Form</label>
          <div class="relative overflow-hidden group">
            @if($headerImage)
              <div class="relative w-full h-32 bg-slate-100 rounded-md overflow-hidden">
                <img src="{{ $headerImage->temporaryUrl() }}" class="w-full h-full object-contain" alt="Preview">
                <button wire:click="removeHeaderImage" class="absolute top-2 right-2 bg-white/90 hover:bg-red-50 text-red-600 p-1.5 rounded-md shadow-sm transition-colors" title="Hapus">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
              </div>
            @elseif($existingHeaderImage)
              <div class="relative w-full h-32 bg-slate-100 rounded-md overflow-hidden">
                <img src="{{ Storage::url($existingHeaderImage) }}" class="w-full h-full object-contain" alt="Existing">
                <button wire:click="removeHeaderImage" class="absolute top-2 right-2 bg-white/90 hover:bg-red-50 text-red-600 p-1.5 rounded-md shadow-sm transition-colors" title="Hapus">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
              </div>
            @else
              <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 flex flex-col items-center justify-center text-center bg-slate-50/50 hover:bg-slate-50 relative">
                <input type="file" wire:model="headerImage" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>
                <div class="text-sm font-medium text-blue-600">Pilih gambar kop surat</div>
                <div class="text-xs text-slate-500 mt-1">Maks. 2MB (Rekomendasi rasio 4:1)</div>
              </div>
            @endif
            @error('headerImage') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Judul Formulir</label>
          <input
            wire:model.live.debounce.300ms="title"
            type="text"
            placeholder="Contoh: Asesmen Awal Semester"
            class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('title') border-red-500 @enderror"
          />
          @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Slug (URL Publik)</label>
          <input
            wire:model.blur="slug"
            type="text"
            placeholder="asesmen-awal"
            class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none font-mono text-sm @error('slug') border-red-500 @enderror"
          />
          <div class="text-xs text-slate-400 mt-1">Akan menjadi /f/&lt;slug&gt;</div>
          @error('slug') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Deskripsi</label>
          <textarea
            wire:model.blur="description"
            rows="3"
            placeholder="Deskripsi singkat ditampilkan di formulir publik"
            class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"
          ></textarea>
        </div>

        <div>
          <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Pesan Sukses</label>
          <textarea
            wire:model.blur="confirmation_message"
            rows="2"
            class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"
          ></textarea>
        </div>

        <div class="flex items-center justify-between border border-slate-200 rounded-md px-4 py-3 bg-slate-50/60">
          <div>
            <div class="text-sm font-medium text-slate-900">Status Formulir</div>
            <div class="text-xs text-slate-500">Saat aktif, responden bisa mengakses link publik.</div>
          </div>
          <button
            wire:click="$toggle('is_active')"
            class="relative w-11 h-6 rounded-full transition-colors {{ $is_active ? 'bg-blue-600' : 'bg-slate-300' }}"
          >
            <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white transition-transform {{ $is_active ? 'translate-x-5' : '' }}"></span>
          </button>
        </div>
      </div>
    </div>
  @else
    <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr_320px] gap-4 lg:gap-6">
      <!-- Left: question list -->
      <aside class="bg-white border border-slate-200 rounded-lg p-4 lg:sticky lg:top-24 lg:self-start">
        <div class="text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500 px-1 mb-3">Daftar Pertanyaan</div>
        <div class="space-y-1">
          @forelse($questions as $index => $q)
            <button
              wire:key="q-list-{{ $q['id'] }}"
              wire:click="setActiveQuestion('{{ $q['id'] }}')"
              class="w-full text-left px-2 py-2 rounded-md flex items-center gap-2 text-sm {{ $activeQuestionId == $q['id'] ? 'bg-blue-50 text-blue-900 border border-blue-200' : 'hover:bg-slate-50 text-slate-700' }}"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="9" cy="12" r="1"/><circle cx="9" cy="5" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="19" r="1"/></svg>
              <span class="font-mono text-[10px] text-slate-400 w-5">{{ $index + 1 }}.</span>
              <span class="flex-1 truncate">{{ $q['label'] ?: 'Tanpa judul' }}</span>
            </button>
          @empty
            <div class="text-xs text-slate-500 px-2 py-3">Belum ada pertanyaan.</div>
          @endforelse
        </div>

        <div class="mt-4 pt-4 border-t border-slate-200">
          <div class="text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500 px-1 mb-2">Tambah</div>
          <div class="grid grid-cols-2 gap-1.5">
            @php
              $types = [
                ['value' => 'short_text', 'label' => 'Teks Singkat', 'icon' => '<path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/>'],
                ['value' => 'paragraph', 'label' => 'Paragraf', 'icon' => '<line x1="21" x2="3" y1="6" y2="6"/><line x1="15" x2="3" y1="12" y2="12"/><line x1="17" x2="3" y1="18" y2="18"/>'],
                ['value' => 'radio', 'label' => 'Pilihan Tunggal', 'icon' => '<circle cx="12" cy="12" r="10"/>'],
                ['value' => 'checkbox', 'label' => 'Kotak Centang', 'icon' => '<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>'],
                ['value' => 'dropdown', 'label' => 'Menu Turun', 'icon' => '<path d="m6 9 6 6 6-6"/>'],
                ['value' => 'date', 'label' => 'Tanggal', 'icon' => '<rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>'],
                ['value' => 'time', 'label' => 'Waktu', 'icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
                ['value' => 'file_upload', 'label' => 'Upload File', 'icon' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/>'],
              ];
            @endphp
            @foreach($types as $type)
              <button
                wire:click="addQuestion('{{ $type['value'] }}')"
                class="text-xs text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-blue-300 rounded-md px-2 py-2 inline-flex items-center gap-1.5"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="text-slate-500">{!! $type['icon'] !!}</svg>
                <span class="truncate">{{ $type['label'] }}</span>
              </button>
            @endforeach
          </div>
        </div>
      </aside>

      <!-- Center: editor -->
      <section class="bg-white border border-slate-200 rounded-lg p-6 min-h-[400px]">
        @php
          $activeQ = null;
          $activeIndex = -1;
          foreach($questions as $index => $q) {
              if ($q['id'] == $activeQuestionId) {
                  $activeQ = $q;
                  $activeIndex = $index;
                  break;
              }
          }
        @endphp

        @if(!$activeQ)
          <div class="h-full min-h-[300px] flex flex-col items-center justify-center text-center">
            <div class="w-12 h-12 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            </div>
            <div class="font-heading text-lg font-medium text-slate-900">Belum ada pertanyaan dipilih</div>
            <p class="text-sm text-slate-500 mt-1">Pilih atau tambahkan tipe pertanyaan dari panel kiri.</p>
          </div>
        @else
          <div class="space-y-5" wire:key="q-editor-{{ $activeQ['id'] }}">
            <div class="flex items-center justify-between">
              @php
                $typeLabel = collect($types)->firstWhere('value', $activeQ['type'])['label'] ?? $activeQ['type'];
              @endphp
              <span class="text-[10px] uppercase tracking-[0.15em] font-semibold text-blue-700 bg-blue-50 border border-blue-200 px-2 py-1 rounded">
                {{ $typeLabel }}
              </span>
              <div class="flex items-center gap-1">
                <button wire:click="moveQuestionUp({{ $activeIndex }})" class="p-1.5 text-slate-500 hover:bg-slate-100 rounded text-xs">↑</button>
                <button wire:click="moveQuestionDown({{ $activeIndex }})" class="p-1.5 text-slate-500 hover:bg-slate-100 rounded text-xs">↓</button>
                <button wire:click="removeQuestion('{{ $activeQ['id'] }}')" class="p-1.5 text-slate-500 hover:text-red-700 hover:bg-red-50 rounded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
              </div>
            </div>

            <div>
              <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Label Pertanyaan</label>
              <input
                wire:model.live.debounce.300ms="questions.{{ $activeIndex }}.label"
                type="text"
                class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none font-heading text-lg"
              />
            </div>

            <div>
              <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Keterangan (Opsional)</label>
              <input
                wire:model.live.debounce.300ms="questions.{{ $activeIndex }}.description"
                type="text"
                placeholder="Petunjuk tambahan untuk responden..."
                class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none text-sm text-slate-600"
              />
            </div>

            <div class="border border-dashed border-slate-300 rounded-lg p-5 bg-slate-50/50">
              <div class="text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500 mb-3">Pratinjau Responden</div>
              
              <div class="mb-3">
                <div class="font-medium text-slate-900">{{ $activeQ['label'] ?: 'Label Pertanyaan' }} @if($activeQ['is_required']) <span class="text-red-500">*</span> @endif</div>
                @if(!empty($activeQ['description']))
                  <div class="text-sm text-slate-500 mt-1">{{ $activeQ['description'] }}</div>
                @endif
              </div>

              @if($activeQ['type'] === 'short_text')
                <input disabled placeholder="Jawaban singkat..." class="w-full border border-slate-300 rounded-md px-3 py-2.5 bg-white" />
              @elseif($activeQ['type'] === 'paragraph')
                <textarea disabled rows="3" placeholder="Jawaban panjang..." class="w-full border border-slate-300 rounded-md px-3 py-2.5 bg-white"></textarea>
              @elseif($activeQ['type'] === 'date')
                <input disabled type="date" class="border border-slate-300 rounded-md px-3 py-2.5 bg-white" />
              @elseif($activeQ['type'] === 'time')
                <input disabled type="time" class="border border-slate-300 rounded-md px-3 py-2.5 bg-white" />
              @elseif($activeQ['type'] === 'dropdown')
                <select disabled class="w-full border border-slate-300 rounded-md px-3 py-2.5 bg-white">
                  <option>— Pilih jawaban —</option>
                  @foreach($activeQ['options'] as $o)
                    <option>{{ $o }}</option>
                  @endforeach
                </select>
              @elseif($activeQ['type'] === 'radio')
                <div class="space-y-2">
                  @foreach($activeQ['options'] as $o)
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                      <input type="radio" disabled class="accent-blue-600" />
                      {{ $o }}
                    </label>
                  @endforeach
                </div>
              @elseif($activeQ['type'] === 'file_upload')
                <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 flex flex-col items-center justify-center text-center bg-white">
                  <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                  </div>
                  <div class="text-sm font-medium text-blue-600">Pilih file</div>
                  <div class="text-xs text-slate-500 mt-1">Maks. ukuran file: 5MB</div>
                </div>
              @elseif($activeQ['type'] === 'checkbox')
                <div class="space-y-2">
                  @foreach($activeQ['options'] as $o)
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                      <input type="checkbox" disabled class="accent-blue-600" />
                      {{ $o }}
                    </label>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        @endif
      </section>



      <!-- Right: settings -->
      <aside class="bg-white border border-slate-200 rounded-lg p-5 lg:sticky lg:top-24 lg:self-start">
        <div class="text-[10px] uppercase tracking-[0.15em] font-semibold text-slate-500 mb-3">Konfigurasi</div>
        
        @if(!$activeQ)
          <p class="text-xs text-slate-500">Pilih pertanyaan untuk mengatur tipe, label, dan pilihan jawaban.</p>
        @else
          <div class="space-y-5" wire:key="q-settings-{{ $activeQ['id'] }}">
            <div>
              <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Tipe</label>
              <select
                wire:model.live="questions.{{ $activeIndex }}.type"
                class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none text-sm"
              >
                @foreach($types as $type)
                  <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex items-center justify-between border border-slate-200 rounded-md px-3 py-2.5">
              <div>
                <div class="text-sm font-medium text-slate-900">Wajib diisi</div>
                <div class="text-xs text-slate-500">Pertanyaan harus dijawab</div>
              </div>
              <button
                wire:click="$toggle('questions.{{ $activeIndex }}.is_required')"
                class="relative w-10 h-5 rounded-full transition-colors {{ $activeQ['is_required'] ? 'bg-blue-600' : 'bg-slate-300' }}"
                style="height: 22px;"
              >
                <span class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-white transition-transform {{ $activeQ['is_required'] ? 'translate-x-5' : '' }}"></span>
              </button>
            </div>

            @if(in_array($activeQ['type'], ['radio', 'checkbox', 'dropdown']))
              <div>
                <label class="block text-xs uppercase tracking-[0.15em] font-semibold text-slate-500 mb-2">Pilihan Jawaban</label>
                <div class="space-y-2">
                  @foreach($activeQ['options'] as $optIndex => $opt)
                    <div class="flex items-center gap-2" wire:key="opt-{{ $activeQ['id'] }}-{{ $optIndex }}">
                      <input
                        wire:model.blur="questions.{{ $activeIndex }}.options.{{ $optIndex }}"
                        type="text"
                        class="flex-1 border border-slate-300 rounded-md px-2.5 py-1.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none"
                      />
                      <button wire:click="removeOption({{ $activeIndex }}, {{ $optIndex }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                      </button>
                    </div>
                  @endforeach
                </div>
                <button
                  wire:click="addOption({{ $activeIndex }})"
                  class="mt-2 text-xs text-blue-600 hover:text-blue-700 inline-flex items-center gap-1"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Tambah pilihan
                </button>
              </div>
            @endif
          </div>
        @endif
      </aside>
    </div>
  @endif
</div>
