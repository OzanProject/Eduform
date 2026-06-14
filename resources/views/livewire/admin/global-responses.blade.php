<x-slot:subtitle>Pantau seluruh jawaban yang masuk dari semua formulir Anda.</x-slot:subtitle>

<div>
  @if($responses->isEmpty())
    <div class="bg-white border border-slate-200 rounded-lg py-20 px-6 text-center shadow-sm">
      <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
      </div>
      <h3 class="font-heading text-lg font-semibold text-slate-900 mb-1">Belum Ada Respon</h3>
      <p class="text-sm text-slate-500 max-w-sm mx-auto">
        Belum ada satupun responden yang mengisi formulir Anda.
      </p>
    </div>
  @else
    <div class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead class="bg-slate-50/80 border-b border-slate-200 text-xs uppercase tracking-wider font-semibold text-slate-500">
            <tr>
              <th class="px-6 py-4 whitespace-nowrap">Waktu Submit</th>
              <th class="px-6 py-4 whitespace-nowrap">Formulir</th>
              <th class="px-6 py-4 whitespace-nowrap">Cuplikan Jawaban (P1)</th>
              <th class="px-6 py-4 text-right whitespace-nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($responses as $res)
              <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-mono text-xs">
                  {{ $res->created_at->format('d M Y, H:i') }}
                </td>
                <td class="px-6 py-4">
                  <a href="{{ route('admin.forms.responses', $res->form->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $res->form->title }}
                  </a>
                </td>
                <td class="px-6 py-4">
                  @php
                    $firstAnswer = $res->answers->first();
                  @endphp
                  @if($firstAnswer)
                    <div class="text-slate-700 truncate max-w-xs" title="{{ $firstAnswer->value }}">
                      <span class="text-slate-400 text-xs mr-1">{{ Str::limit($firstAnswer->question->text, 20) }}:</span>
                      {{ Str::limit($firstAnswer->value, 40) }}
                    </div>
                  @else
                    <span class="text-slate-400 italic">Tidak ada jawaban spesifik</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                  <a href="{{ route('admin.forms.responses', $res->form->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-white border border-slate-300 text-slate-700 rounded-md hover:bg-slate-50 transition-colors shadow-sm">
                    Lihat Lengkap
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                  </a>
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
    </div>
  @endif
</div>
