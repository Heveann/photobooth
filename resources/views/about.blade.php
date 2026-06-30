@extends('layouts.app')

@section('title', 'About - Photobooth')

@section('content')
<div class="max-w-3xl mx-auto py-12">
    <div class="text-center mb-16 reveal-up">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-6 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-accent-pink animate-pulse"></span>
            <span class="text-[13px] font-semibold tracking-wide text-text-secondary uppercase">Our Story</span>
        </div>
        <h1 class="text-5xl font-display font-bold mb-4 tracking-tight text-text-main">About <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-pink to-accent-rose">Photobooth</span></h1>
        <p class="text-lg text-text-secondary">The Modern Premium Photobooth Experience</p>
    </div>
    
    <div class="glass-card p-10 reveal-up delay-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-pink-100 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="relative z-10">
            <h2 class="text-3xl font-display font-semibold mb-6 text-text-main">Our Vision</h2>
            <p class="text-text-secondary text-lg leading-relaxed mb-10">
                Photobooth brings the popular aesthetic self-photo studio experience directly to your web browser. 
                We believe that capturing memories should be intuitive, accessible, and breathtakingly beautiful. 
                By combining modern web technologies with premium editorial design, we've created a seamless way to preserve your favorite moments.
            </p>
            
            <h2 class="text-2xl font-display font-semibold mb-6 text-text-main">Premium Features</h2>
            <ul class="space-y-4">
                <li class="flex items-center gap-4 bg-white/50 p-4 rounded-xl shadow-sm border border-white">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-100 to-rose-100 text-accent-pink flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span class="text-text-main font-medium">Multiple aesthetic templates (classic 4-cut, dark mode)</span>
                </li>
                <li class="flex items-center gap-4 bg-white/50 p-4 rounded-xl shadow-sm border border-white">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-100 to-rose-100 text-accent-pink flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span class="text-text-main font-medium">Live camera filters for that perfect pastel vibe</span>
                </li>
                <li class="flex items-center gap-4 bg-white/50 p-4 rounded-xl shadow-sm border border-white">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-100 to-rose-100 text-accent-pink flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span class="text-text-main font-medium">Local, private processing for complete security</span>
                </li>
                <li class="flex items-center gap-4 bg-white/50 p-4 rounded-xl shadow-sm border border-white">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-100 to-rose-100 text-accent-pink flex items-center justify-center shadow-inner flex-shrink-0">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span class="text-text-main font-medium">High-fidelity instant downloads & sharing links</span>
                </li>
            </ul>
            
            <div class="mt-12 text-center pt-8 border-t border-gray-100">
                <a href="{{ route('camera') }}" class="btn-gradient px-8 py-3.5 rounded-full text-white font-semibold shadow-md inline-block hover:shadow-lg transform hover:-translate-y-1 transition-all">Start Capturing Now</a>
            </div>
        </div>
    </div>
</div>
@endsection
