<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LetsAyurveda | Admin Portal</title>
    <meta name="robots" content="noindex, nofollow"/>
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet"/>
    
    <!-- Vite Assets (compiled Tailwind CSS v4 & AlpineJS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-body-md antialiased text-slate-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Component -->
        <livewire:admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Header Component -->
            <livewire:admin.header />

            <!-- Main Content Scroll Container -->
            <main class="flex-1 overflow-y-auto bg-slate-50/50 p-6 md:p-8">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
        
    </div>
</body>
</html>
