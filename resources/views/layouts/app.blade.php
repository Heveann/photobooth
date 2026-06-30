<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Photobooth - Premium Experience')</title>
    <meta name="description" content="Aesthetic and modern premium photobooth experience">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            --font-display: 'Plus Jakarta Sans', sans-serif;
            
            --color-pastel-bg: #fffcfc;
            --color-pastel-pink: #ffe8ec;
            --color-pastel-peach: #ffebd9;
            --color-pastel-blue: #e8f0ff;
            --color-accent-pink: #ff6b98;
            --color-accent-rose: #ff5c77;
            --color-text-main: #1d1d1f;
            --color-text-secondary: #86868b;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--color-pastel-bg);
            color: var(--color-text-main);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, .font-display {
            font-family: var(--font-display);
            letter-spacing: -0.03em;
        }

        /* Glassmorphism utility */
        .glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(255, 182, 193, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            box-shadow: 0 10px 40px -10px rgba(255, 107, 152, 0.08);
            transition: all 0.3s ease;
        }

        /* Blob Background */
        .blob-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
            background-color: #fdfbfb;
            pointer-events: none;
        }
        
        .blob {
            position: absolute;
            filter: blur(90px);
            opacity: 0.6;
            animation: float 20s infinite ease-in-out;
            border-radius: 50%;
        }

        .blob-1 {
            top: -10%;
            left: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, #ffdee9 0%, rgba(255,222,233,0) 70%);
            animation-delay: 0s;
        }

        .blob-2 {
            bottom: -20%;
            right: -10%;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, #f5e3ff 0%, rgba(245,227,255,0) 70%);
            animation-delay: -5s;
        }
        
        .blob-3 {
            top: 30%;
            left: 20%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, #e3f6ff 0%, rgba(227,246,255,0) 70%);
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(40px, -60px) scale(1.1); }
            66% { transform: translate(-30px, 30px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* Button Gradient */
        .btn-gradient {
            background: linear-gradient(135deg, var(--color-accent-pink) 0%, var(--color-accent-rose) 100%);
            box-shadow: 0 8px 25px rgba(255, 107, 152, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            color: white;
            border: none;
        }
        
        .btn-gradient::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255,255,255,0.2), rgba(255,255,255,0));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 12px 30px rgba(255, 107, 152, 0.4);
        }
        
        .btn-gradient:hover::after {
            opacity: 1;
        }
        
        .btn-gradient:active {
            transform: translateY(1px) scale(0.98);
            box-shadow: 0 4px 15px rgba(255, 107, 152, 0.3);
        }
        
        /* Reveal Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            animation: revealUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        @keyframes revealUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Cursor */
        @media (pointer: fine) {
            * {
                cursor: none !important;
            }
        }

        .custom-cursor-dot,
        .custom-cursor-outline {
            position: fixed;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 99999;
            pointer-events: none;
        }

        .custom-cursor-dot {
            width: 8px;
            height: 8px;
            background-color: var(--color-accent-pink);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }

        .custom-cursor-outline {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(255, 107, 152, 0.5);
            background-color: rgba(255, 107, 152, 0.05);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }
        
        /* Interactive state */
        .cursor-hover .custom-cursor-dot {
            width: 12px;
            height: 12px;
            background-color: var(--color-accent-rose);
        }
        
        .cursor-hover .custom-cursor-outline {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 107, 152, 0.1);
            border-color: var(--color-accent-rose);
        }
        
        @yield('styles')
    </style>
</head>
<body class="selection:bg-pink-200 selection:text-pink-900 flex flex-col min-h-screen">

    <!-- Animated Blob Background -->
    <div class="blob-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Floating Navigation -->
    <nav class="sticky top-6 mx-auto w-[92%] max-w-6xl glass rounded-full px-6 py-4 flex items-center justify-between z-50 transition-all duration-300">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-accent-pink to-accent-rose flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
            </div>
            <span class="font-display font-bold text-xl tracking-tight text-text-main group-hover:text-accent-pink transition-colors">Photobooth</span>
        </a>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8 font-medium text-sm text-text-secondary">
            <a href="{{ route('home') }}#features" class="hover:text-accent-pink transition-colors">Features</a>
            <a href="{{ route('gallery') }}" class="hover:text-accent-pink transition-colors">Gallery</a>
            <a href="{{ route('about') }}" class="hover:text-accent-pink transition-colors">About</a>
        </div>

        <!-- Auth / Profile -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.login') }}" class="text-sm font-medium text-text-secondary hover:text-accent-pink transition-colors px-3 py-2 hidden sm:block">Log in</a>
            <a href="{{ route('camera') }}" class="text-sm font-semibold bg-text-main text-white rounded-full px-5 py-2.5 hover:bg-black transition-colors shadow-md hover:shadow-lg hover:scale-105 active:scale-95 duration-200">Try Demo</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 relative z-10 pt-16 pb-20 flex flex-col items-center">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white/40 backdrop-blur-lg border-t border-white/60 py-10 z-10 mt-auto">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-accent-pink to-accent-rose flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                </div>
                <span class="font-display font-bold text-lg text-text-main">Photobooth</span>
            </div>
            
            <p class="text-sm text-text-secondary font-medium">
                &copy; {{ date('Y') }} Photobooth Experience. All rights reserved.
            </p>
            
            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-text-secondary hover:text-accent-pink hover:shadow-md transition-all">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-text-secondary hover:text-accent-pink hover:shadow-md transition-all">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <!-- Reveal script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-up').forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });
        });
    </script>

    <!-- Custom Cursor Elements -->
    <div class="custom-cursor-dot"></div>
    <div class="custom-cursor-outline"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (window.matchMedia("(pointer: fine)").matches) {
                const cursorDot = document.querySelector('.custom-cursor-dot');
                const cursorOutline = document.querySelector('.custom-cursor-outline');
                
                let mouseX = 0;
                let mouseY = 0;
                let outlineX = 0;
                let outlineY = 0;
                
                window.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                    cursorDot.style.transform = `translate(calc(${mouseX}px - 50%), calc(${mouseY}px - 50%))`;
                });
                
                function animate() {
                    let distX = mouseX - outlineX;
                    let distY = mouseY - outlineY;
                    
                    outlineX = outlineX + (distX * 0.15);
                    outlineY = outlineY + (distY * 0.15);
                    
                    cursorOutline.style.transform = `translate(calc(${outlineX}px - 50%), calc(${outlineY}px - 50%))`;
                    
                    requestAnimationFrame(animate);
                }
                animate();

                // Interactive elements hover effect using event delegation
                document.body.addEventListener('mouseover', (e) => {
                    if (e.target.closest('a, button, input, select, textarea, [role="button"], .interactive')) {
                        document.body.classList.add('cursor-hover');
                    }
                });
                
                document.body.addEventListener('mouseout', (e) => {
                    if (e.target.closest('a, button, input, select, textarea, [role="button"], .interactive')) {
                        document.body.classList.remove('cursor-hover');
                    }
                });
            } else {
                document.querySelector('.custom-cursor-dot').style.display = 'none';
                document.querySelector('.custom-cursor-outline').style.display = 'none';
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
