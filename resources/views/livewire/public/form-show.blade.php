<div class="max-w-3xl mx-auto">
  @if($errorMessage)
    <div class="bg-white rounded-2xl shadow-md border border-slate-200 border-t-8 border-t-red-500 p-10 text-center flex flex-col items-center justify-center min-h-[50vh]">
      <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-red-50/50">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      </div>
      <h1 class="font-heading text-3xl font-semibold text-slate-900 mb-3 tracking-tight">Formulir Tidak Tersedia</h1>
      <p class="text-slate-500 text-lg max-w-md mx-auto">{{ $errorMessage }}</p>
    </div>
  @elseif($isSubmitted)
    <div class="bg-white rounded-2xl shadow-md border border-slate-200 border-t-8 border-t-green-500 p-10 text-center flex flex-col items-center justify-center min-h-[50vh]">
      <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-green-50/50">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      </div>
      <h1 class="font-heading text-3xl font-semibold text-slate-900 mb-3 tracking-tight">Berhasil Terkirim</h1>
      <p class="text-slate-500 text-lg max-w-md mx-auto leading-relaxed">{{ $form->confirmation_message ?? 'Terima kasih, respon Anda telah direkam.' }}</p>
      
      <div class="mt-8 pt-6 border-t border-slate-100 w-full max-w-sm mx-auto">
        <a href="javascript:location.reload()" class="inline-flex items-center justify-center text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline decoration-blue-300 underline-offset-4 transition-all">
          Kirim respon lain
        </a>
      </div>
    </div>
  @else
    @if($form->header_image)
      <div class="mb-6 rounded-xl overflow-hidden shadow-sm bg-white border border-slate-200">
        <img src="{{ Storage::url($form->header_image) }}" alt="Form Header" class="w-full h-auto max-h-64 object-contain">
      </div>
    @endif
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 border-t-8 border-t-blue-600 p-8 mb-6 relative overflow-hidden">
      <!-- Decorative background element -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-16 -mt-16 opacity-50"></div>
      
      <div class="relative z-10">
        <h1 class="font-heading text-3xl sm:text-4xl font-semibold text-slate-900 mb-3 tracking-tight">{{ $form->title }}</h1>
        @if($form->description)
          <p class="text-slate-600 whitespace-pre-line leading-relaxed text-base sm:text-lg">{{ $form->description }}</p>
        @endif
        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-red-500">
          <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
          Menunjukkan pertanyaan wajib
        </div>
      </div>
    </div>

    <form wire:submit="submit" class="space-y-6" x-data="{ isRobotChecked: false }">
      @foreach($form->questions as $q)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8 transition-colors duration-300 {{ $errors->has('answers.'.$q->id) ? 'border-red-300 ring-1 ring-red-300 bg-red-50/30' : 'hover:border-blue-300 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500' }}">
          <div class="mb-5">
            <h2 class="font-medium text-slate-900 text-lg leading-snug">
              {{ $q->text }} 
              @if($q->is_required) <span class="text-red-500 ml-1 font-bold">*</span> @endif
            </h2>
            @if($q->description)
              <p class="text-sm text-slate-500 mt-2 leading-relaxed">{{ $q->description }}</p>
            @endif
          </div>

          <div>
            @if($q->type === 'short_text')
              <input 
                wire:model.blur="answers.{{ $q->id }}"
                type="text" 
                placeholder="Jawaban Anda"
                class="w-full border-b border-slate-300 bg-transparent px-0 py-3 focus:border-blue-600 focus:ring-0 outline-none transition-colors text-slate-800 placeholder:text-slate-400"
              >
            
            @elseif($q->type === 'paragraph')
              <textarea 
                wire:model.blur="answers.{{ $q->id }}"
                rows="3" 
                placeholder="Jawaban Anda"
                class="w-full border border-slate-300 rounded-lg bg-transparent px-4 py-3 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all resize-y text-slate-800 placeholder:text-slate-400 mt-1"
              ></textarea>
            
            @elseif($q->type === 'radio')
              <div class="space-y-4 mt-2">
                @foreach($q->options->pluck('value') as $opt)
                  <label class="flex items-start gap-4 cursor-pointer group p-2 -ml-2 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center h-6">
                      <input 
                        wire:model.blur="answers.{{ $q->id }}"
                        type="radio" 
                        name="q_{{ $q->id }}" 
                        value="{{ $opt }}"
                        class="w-5 h-5 text-blue-600 border-slate-300 focus:ring-blue-500 focus:ring-offset-2 transition-shadow"
                      >
                    </div>
                    <span class="text-slate-700 group-hover:text-slate-900 leading-6">{{ $opt }}</span>
                  </label>
                @endforeach
              </div>
            
            @elseif($q->type === 'checkbox')
              <div class="space-y-4 mt-2">
                @foreach($q->options->pluck('value') as $opt)
                  <label class="flex items-start gap-4 cursor-pointer group p-2 -ml-2 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center h-6">
                      <input 
                        wire:model.blur="answers.{{ $q->id }}"
                        type="checkbox" 
                        value="{{ $opt }}"
                        class="w-5 h-5 rounded text-blue-600 border-slate-300 focus:ring-blue-500 focus:ring-offset-2 transition-shadow"
                      >
                    </div>
                    <span class="text-slate-700 group-hover:text-slate-900 leading-6">{{ $opt }}</span>
                  </label>
                @endforeach
              </div>
            
            @elseif($q->type === 'dropdown')
              <select 
                wire:model.blur="answers.{{ $q->id }}"
                class="w-full border border-slate-300 rounded-lg bg-white px-4 py-3 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all text-slate-800 mt-1"
              >
                <option value="">-- Pilih Jawaban --</option>
                @foreach($q->options->pluck('value') as $opt)
                  <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
              </select>
            
            @elseif($q->type === 'date')
              <input 
                wire:model.blur="answers.{{ $q->id }}"
                type="date" 
                class="w-full sm:max-w-xs border border-slate-300 rounded-lg bg-transparent px-4 py-3 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none transition-all text-slate-800 mt-1"
              >
            
            @elseif($q->type === 'time')
              <input 
                wire:model.blur="answers.{{ $q->id }}"
                type="time" 
                class="w-full sm:w-auto border border-slate-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none bg-white text-slate-700 transition-all mt-1 cursor-pointer"
              >
            
            @elseif($q->type === 'file_upload')
              <div 
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                class="relative border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-xl p-8 transition-colors group cursor-pointer bg-slate-50/50 mt-1"
              >
                <input 
                  wire:model="answers.{{ $q->id }}"
                  type="file" 
                  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                >
                <div class="flex flex-col items-center justify-center pointer-events-none">
                  <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                  </div>
                  <div class="text-base font-medium text-slate-900 mb-1">
                    @if($answers[$q->id] ?? null)
                      <span class="text-blue-600">{{ is_string($answers[$q->id]) ? $answers[$q->id] : $answers[$q->id]->getClientOriginalName() }}</span>
                    @else
                      Pilih file atau tarik ke sini
                    @endif
                  </div>
                  <div class="text-sm text-slate-500">Maksimal ukuran file: 5MB</div>
                  
                  <div x-show="isUploading" class="w-full max-w-xs mt-5" style="display: none;">
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                      <div class="h-full bg-blue-600 transition-all duration-300 relative overflow-hidden" x-bind:style="'width: ' + progress + '%'">
                        <div class="absolute inset-0 bg-white/20 animate-[shimmer_1s_infinite]"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>

          @error('answers.'.$q->id)
            <div class="mt-4 p-3 bg-red-50 text-sm text-red-600 rounded-lg flex items-start gap-2 border border-red-100">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              <span>{{ $message }}</span>
            </div>
          @enderror
        </div>
      @endforeach

      <!-- Anti-Spam / Robot Verification -->
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 {{ $errors->has('isNotRobot') ? 'border-red-300 ring-1 ring-red-300 bg-red-50/30' : 'hover:border-blue-300 transition-colors' }}">
        <label class="flex items-center gap-4 cursor-pointer group">
          <div class="relative flex items-center justify-center w-8 h-8 rounded border-2 {{ $errors->has('isNotRobot') ? 'border-red-400 bg-red-50' : 'border-slate-300 bg-slate-50 group-hover:border-blue-500' }} transition-colors">
            <input 
              type="checkbox" 
              wire:model="isNotRobot"
              x-model="isRobotChecked"
              class="peer opacity-0 absolute inset-0 w-full h-full cursor-pointer z-10"
            >
            <svg class="w-5 h-5 text-blue-600 transition-transform duration-200 scale-0 peer-checked:scale-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          </div>
          <div class="flex-1">
            <span class="font-medium text-slate-800 text-lg group-hover:text-slate-900 transition-colors">Saya bukan robot</span>
            <div class="text-xs text-slate-500 mt-0.5 flex items-center gap-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Verifikasi Keamanan
            </div>
          </div>
          <div class="hidden sm:block opacity-30 group-hover:opacity-60 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4.5c.3 0 .5.2.5.5v2.8c0 .3-.2.5-.5.5H8.5c-.3 0-.5.2-.5.5v2.8c0 .3.2.5.5.5h4.5c.3 0 .5.2.5.5v2.8c0 .3-.2.5-.5.5H12a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-8z"/><path d="M6 14H5a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2h1"/></svg>
          </div>
        </label>
        
        @error('isNotRobot')
          <div class="mt-3 text-sm text-red-600 flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-4 pt-4 pb-8">
        <button type="button" wire:click="$refresh" class="text-sm font-medium text-slate-500 hover:text-red-600 transition-colors py-2 px-4 rounded-lg hover:bg-red-50 sm:px-0 sm:hover:bg-transparent">
          Kosongkan formulir
        </button>
        
        <button 
          type="submit"
          x-bind:disabled="!isRobotChecked"
          wire:loading.attr="disabled"
          class="group relative inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-8 py-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:bg-blue-600 overflow-hidden w-full sm:w-auto shadow-md hover:shadow-lg focus:ring-4 focus:ring-blue-500/30 outline-none"
        >
          <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
          <span wire:loading.remove wire:target="submit" class="relative z-10">Kirim Respon</span>
          <span wire:loading wire:target="submit" class="relative z-10">Mengirim...</span>
          <svg wire:loading wire:target="submit" class="animate-spin relative z-10" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
        </button>
      </div>
    </form>
  @endif
</div>
