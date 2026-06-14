@props(['brandName' => 'EduForm', 'fullBrandName' => 'EduForm Assessment'])
<!-- Footer -->
<footer class="border-t border-slate-200 bg-white relative z-10 pt-10 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <span class="font-heading font-semibold text-slate-800">{{ $brandName }}</span>
        </div>
        <p class="text-sm text-slate-500 text-center sm:text-right">
            &copy; {{ date('Y') }} {{ $fullBrandName }}. All rights reserved.<br>
            <span class="mt-1 inline-block">Development by <a href="https://ozanproject.site" target="_blank" rel="noopener noreferrer" class="font-medium text-blue-500 hover:text-blue-600 hover:underline transition-colors">Ozan Project</a></span>
        </p>
    </div>
</footer>
