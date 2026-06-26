<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'LetsAyurveda' }}</title>
    <meta name="robots" content="noindex, nofollow"/>
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet"/>
    
    <!-- Vite Assets (compiled Tailwind CSS v4 & AlpineJS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-body-md antialiased text-on-surface flex items-center justify-center bg-gradient-to-br from-secondary/10 via-background to-primary/10 p-4">
    
    {{ $slot }}

    @include('components.admin.toast')
</body>
</html>
