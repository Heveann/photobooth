@extends('layouts.app')

@section('styles')
/* Floating elements */
.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-slow 7s ease-in-out infinite -3s;
}

@keyframes float-slow {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

/* Photostrip styling */
.photostrip {
    background: white;
    padding: 12px;
    border-radius: 16px;
    box-shadow: 0 15px 50px -10px rgba(0,0,0,0.08);
    transform: rotate(-6deg);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(0,0,0,0.02);
}

.photostrip:hover {
    transform: rotate(-2deg) scale(1.05);
    box-shadow: 0 25px 60px -15px rgba(255, 107, 152, 0.2);
}

.photostrip-right {
    transform: rotate(8deg);
}

.photostrip-right:hover {
    transform: rotate(3deg) scale(1.05);
}

.photo-frame {
    width: 140px;
    height: 180px;
    background: #f8f8f8;
    margin-bottom: 12px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 0 10px rgba(0,0,0,0.02);
}

.photo-frame:last-child {
    margin-bottom: 0;
}
@endsection

@section('content')
<!-- Hero Section -->
<section class="w-full max-w-7xl mx-auto min-h-[70vh] flex items-center justify-center relative -mt-6">
    
    <!-- Left Decorative Photostrip -->
    <div class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 animate-float-slow z-0">
        <div class="photostrip">
            <div class="photo-frame bg-pink-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Friends" class="w-full h-full object-cover opacity-80" />
            </div>
            <div class="photo-frame bg-blue-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1529156069898-49953eb1b5b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Fun" class="w-full h-full object-cover opacity-80" />
            </div>
            <div class="photo-frame bg-peach-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Smile" class="w-full h-full object-cover opacity-80" />
            </div>
        </div>
    </div>

    <!-- Center Content -->
    <div class="max-w-3xl mx-auto text-center z-10 w-full px-4">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8 shadow-sm reveal-up">
            <span class="w-2 h-2 rounded-full bg-accent-pink animate-pulse"></span>
            <span class="text-[13px] font-semibold tracking-wide text-text-secondary">Capture the moment</span>
        </div>
        
        <h1 class="font-display text-6xl sm:text-7xl lg:text-[84px] font-extrabold text-text-main mb-6 tracking-tight leading-[1.1] reveal-up delay-100">
            Memories made <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-pink to-accent-rose">beautiful.</span>
        </h1>
        
        <p class="text-lg md:text-xl text-text-secondary mb-12 max-w-2xl mx-auto font-light leading-relaxed reveal-up delay-200">
            Experience a premium web-based photobooth. Soft pastel filters, elegant interfaces, and magical moments captured instantly directly from your browser.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 reveal-up delay-300">
            <a href="{{ route('camera') }}" class="btn-gradient text-white rounded-full px-10 py-4 font-semibold text-lg flex items-center gap-3 w-full sm:w-auto justify-center group">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-12 transition-transform duration-300"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                Start Capturing
            </a>
            <a href="{{ route('gallery') }}" class="px-10 py-4 rounded-full font-semibold text-text-main bg-white/70 hover:bg-white/95 backdrop-blur-md shadow-sm hover:shadow-md transition-all border border-white/50 w-full sm:w-auto justify-center flex hover:-translate-y-0.5">
                View Gallery
            </a>
        </div>
    </div>

    <!-- Right Decorative Photostrip -->
    <div class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 animate-float-delayed z-0">
        <div class="photostrip photostrip-right">
            <div class="photo-frame bg-purple-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Pose" class="w-full h-full object-cover opacity-80" />
            </div>
            <div class="photo-frame bg-green-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Portrait" class="w-full h-full object-cover opacity-80" />
            </div>
            <div class="photo-frame bg-yellow-100 flex items-center justify-center overflow-hidden">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Guy" class="w-full h-full object-cover opacity-80" />
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="w-full max-w-6xl mx-auto px-4 py-24 z-10 relative">
    <div class="text-center mb-16 reveal-up">
        <h2 class="font-display text-4xl font-bold text-text-main mb-4">Premium Experience</h2>
        <p class="text-text-secondary max-w-xl mx-auto">Every detail has been crafted to provide an elegant, fast, and secure photobooth session.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="glass-card p-8 reveal-up delay-100">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-100 to-rose-100 flex items-center justify-center mb-6 text-accent-pink shadow-inner">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h3 class="font-display text-xl font-semibold mb-3 text-text-main">Soft Aesthetics</h3>
            <p class="text-text-secondary leading-relaxed">Carefully curated pastel filters and lighting adjustments to make every capture look like a luxury editorial.</p>
        </div>
        
        <!-- Feature 2 -->
        <div class="glass-card p-8 reveal-up delay-200">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center mb-6 text-blue-500 shadow-inner">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            </div>
            <h3 class="font-display text-xl font-semibold mb-3 text-text-main">Instant Layouts</h3>
            <p class="text-text-secondary leading-relaxed">Choose from beautiful grid layouts, classic strips, and polaroid styles that automatically arrange your moments.</p>
        </div>
        
        <!-- Feature 3 -->
        <div class="glass-card p-8 reveal-up delay-300">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center mb-6 text-emerald-500 shadow-inner">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h3 class="font-display text-xl font-semibold mb-3 text-text-main">Private by Design</h3>
            <p class="text-text-secondary leading-relaxed">Your photos are processed locally and securely. Keep them private or share them to the public gallery—it's your choice.</p>
        </div>
    </div>
</section>
@endsection
