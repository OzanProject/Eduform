@props(['fullBrandName' => 'EduForm Assessment', 'brandLogoPath' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $fullBrandName }} - Modern Form Builder</title>
    <meta name="description" content="Platform terbaik untuk mengumpulkan data, survei, dan evaluasi menggunakan {{ $fullBrandName }}.">
    <meta name="keywords" content="form builder, online forms, survei online, {{ $fullBrandName }}, Ozan Project">
    <meta name="author" content="Ozan Project">
    <meta name="theme-color" content="#3b82f6">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $fullBrandName }} - Modern Form Builder">
    <meta property="og:description" content="Platform terbaik untuk mengumpulkan data, survei, dan evaluasi. Responsif, interaktif, dan dirancang khusus untuk kenyamanan Anda.">
    @if($brandLogoPath)
        <meta property="og:image" content="{{ asset('storage/' . $brandLogoPath) }}">
        <link rel="icon" href="{{ asset('storage/' . $brandLogoPath) }}" type="image/png">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $fullBrandName }} - Modern Form Builder">
    <meta property="twitter:description" content="Platform terbaik untuk mengumpulkan data, survei, dan evaluasi. Responsif, interaktif, dan dirancang khusus untuk kenyamanan Anda.">
    @if($brandLogoPath)
        <meta property="twitter:image" content="{{ asset('storage/' . $brandLogoPath) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Outfit', sans-serif; }
        
        /* Animated Background Gradients */
        .bg-gradient-animate {
            background-size: 200% 200%;
            animation: gradient-move 8s ease infinite;
        }
        @keyframes gradient-move {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Abstract Shape */
        .shape-blob {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            animation: blob-bounce 15s infinite ease-in-out alternate;
        }
        @keyframes blob-bounce {
            0% { transform: scale(1) translate(0px, 0px); border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { transform: scale(1.1) translate(30px, -40px); border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { transform: scale(0.9) translate(-30px, 40px); border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden selection:bg-blue-500 selection:text-white">

    <!-- Decorative Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] shape-blob opacity-[0.06] blur-[80px]"></div>
        <div class="absolute bottom-[20%] right-[-5%] w-[400px] h-[400px] bg-gradient-to-l from-indigo-400 to-blue-500 rounded-full opacity-[0.06] blur-[100px]"></div>
    </div>

    {{ $slot }}

</body>
</html>
