<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
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
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased min-h-screen">
    {{ $slot }}
</body>
</html>
