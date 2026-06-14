<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $brandLogoPath = \App\Models\Setting::where('key', 'brand_logo')->value('value');
        $brandName = \App\Models\Setting::where('key', 'brand_name')->value('value') ?? 'EduForm';
        $brandSubtitle = \App\Models\Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment';
        $fullBrandName = trim($brandName . ' ' . $brandSubtitle);
    @endphp
    @if($brandLogoPath)
        <link rel="icon" href="{{ asset('storage/' . $brandLogoPath) }}" type="image/png">
    @endif
    <title>{{ isset($title) ? $title . ' - ' . $fullBrandName : $fullBrandName }}</title>
    
    <meta name="description" content="{{ isset($description) ? $description : 'Formulir online dan survei dari ' . $fullBrandName }}">
    <meta name="theme-color" content="#3b82f6">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ isset($title) ? $title : $fullBrandName }}">
    <meta property="og:description" content="{{ isset($description) ? $description : 'Isi formulir online ini dengan mudah melalui perangkat apa saja.' }}">
    @if($brandLogoPath)
        <meta property="og:image" content="{{ asset('storage/' . $brandLogoPath) }}">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ isset($title) ? $title : $fullBrandName }}">
    <meta property="twitter:description" content="{{ isset($description) ? $description : 'Isi formulir online ini dengan mudah melalui perangkat apa saja.' }}">
    @if($brandLogoPath)
        <meta property="twitter:image" content="{{ asset('storage/' . $brandLogoPath) }}">
    @endif
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col relative overflow-x-hidden selection:bg-blue-500 selection:text-white">
    <!-- Decorative Background Shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full opacity-[0.05] blur-[80px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-l from-teal-400 to-blue-500 rounded-full opacity-[0.05] blur-[100px]"></div>
    </div>
    
    <!-- Sticky Navbar -->
    <header class="sticky top-0 z-40 w-full bg-white/70 backdrop-blur-md border-b border-white/20 shadow-sm transition-all duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-center sm:justify-start gap-3">
            @if($brandLogoPath)
                <img src="{{ asset('storage/' . $brandLogoPath) }}" alt="Logo" class="w-8 h-8 object-contain">
            @else
                <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21.42 10.922a2 2 0 0 0-.019-3.838L12.83 4.34a2 2 0 0 0-1.66 0L2.6 7.08a2 2 0 0 0 0 3.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>
                </div>
            @endif
            <div class="flex flex-col">
                <span class="font-heading font-semibold text-slate-800 text-lg leading-none">{{ $brandName }}</span>
                <span class="text-[10px] uppercase tracking-widest text-slate-500 mt-0.5">{{ $brandSubtitle }}</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative z-10 flex-grow py-8 px-4 sm:px-6 w-full max-w-4xl mx-auto">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="w-full bg-transparent py-6 border-t border-slate-200 mt-auto">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} <span class="font-medium text-slate-700">{{ $fullBrandName }}</span>. All rights reserved.<br>
            <span class="text-xs text-slate-400 mt-1 inline-block">Development by <a href="https://ozanproject.site" target="_blank" rel="noopener noreferrer" class="font-medium text-blue-500 hover:text-blue-600 hover:underline transition-colors">Ozan Project</a></span>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
