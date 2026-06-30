<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - ClaudeBooth')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', sans-serif;
            --font-serif: 'Tiempos Headline', 'Cormorant Garamond', serif;
            --font-mono: 'JetBrains Mono', monospace;
            
            --color-primary: #cc785c;
            --color-primary-active: #a9583e;
            --color-ink: #141413;
            --color-body: #3d3d3a;
            --color-muted: #6c6a64;
            --color-canvas: #faf9f5;
            --color-surface-card: #efe9de;
            --color-surface-dark: #181715;
            --color-hairline: #e6dfd8;
            --color-on-primary: #ffffff;
            --color-on-dark: #faf9f5;
        }
        
        body {
            font-family: var(--font-sans);
            background-color: var(--color-canvas);
            color: var(--color-body);
        }
        
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: var(--font-serif);
            color: var(--color-ink);
            letter-spacing: -0.02em;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-on-primary);
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: var(--color-primary-active);
        }

        .sidebar {
            background-color: var(--color-surface-dark);
            color: var(--color-on-dark);
        }
        
        .card-cream {
            background-color: var(--color-surface-card);
            border-radius: 12px;
            border: 1px solid var(--color-hairline);
        }
    </style>
</head>
<body class="antialiased flex h-screen overflow-hidden">

    @auth
    <!-- Sidebar -->
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col h-full hidden md:flex border-r border-[#252320]">
        <div class="p-6 flex items-center gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-on-dark">
                <path d="M12 2L12 22M2 12L22 12M5 5L19 19M5 19L19 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h1 class="text-xl font-medium font-serif text-on-dark tracking-[-0.5px]">Admin Console</h1>
        </div>
        <nav class="flex-1 px-4 space-y-1 mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-[#252320] text-white' : 'text-[#a09d96] hover:bg-[#1f1e1b] hover:text-white' }} transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                Overview
            </a>
            <a href="{{ route('admin.templates.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('admin.templates.*') ? 'bg-[#252320] text-white' : 'text-[#a09d96] hover:bg-[#1f1e1b] hover:text-white' }} transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Templates
            </a>
            <a href="{{ route('admin.photos.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('admin.photos.*') ? 'bg-[#252320] text-white' : 'text-[#a09d96] hover:bg-[#1f1e1b] hover:text-white' }} transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                Artifacts
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-[#252320] text-white' : 'text-[#a09d96] hover:bg-[#1f1e1b] hover:text-white' }} transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Settings
            </a>
        </nav>
        <div class="p-4 border-t border-[#252320]">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 w-full rounded-md text-sm font-medium text-[#c64545] hover:bg-[#1f1e1b] transition-colors">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Sign out
                </button>
            </form>
        </div>
    </aside>
    @endauth

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        @auth
        <header class="bg-[#faf9f5] border-b border-hairline px-8 py-4 flex justify-between items-center z-10">
            <div class="md:hidden">
                <button class="text-ink">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                </button>
            </div>
            <div class="text-[22px] font-medium font-serif">@yield('header_title', 'Admin Dashboard')</div>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" target="_blank" class="text-[14px] text-primary hover:underline font-medium">View public site</a>
                <div class="w-8 h-8 rounded-full bg-[#181715] flex items-center justify-center text-[#faf9f5] font-medium text-xs">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>
        @endauth

        <div class="flex-1 overflow-auto p-8 bg-[#faf9f5]">
            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>
</html>
