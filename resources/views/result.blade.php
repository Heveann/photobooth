@extends('layouts.app')

@section('title', 'Your Photos - Photobooth')

@section('content')
<div class="max-w-[1000px] mx-auto text-center py-12">
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8 shadow-sm reveal-up">
        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
        <span class="text-[13px] font-semibold tracking-wide text-text-secondary uppercase">Artifact Rendered</span>
    </div>
    
    <h1 class="text-5xl md:text-6xl font-display font-extrabold tracking-tight mb-12 text-text-main reveal-up delay-100">Session complete.</h1>
    
    <div class="glass-card p-10 flex flex-col md:flex-row gap-12 items-center justify-center reveal-up delay-200 border-t-[4px] border-t-accent-pink">
        <!-- Result Preview -->
        <div class="w-full md:w-1/2 flex justify-center">
            <div class="bg-white p-4 pb-16 rounded-xl shadow-xl transform -rotate-2 relative max-w-sm w-full border border-gray-100 transition-transform hover:-rotate-1 hover:scale-105 duration-300">
                <div class="grid grid-cols-1 gap-2">
                    @php $finalPhoto = $session->photos->where('is_final', true)->first() ?? $session->photos->first(); @endphp
                    @if($finalPhoto)
                        <div class="aspect-[1/3] bg-gray-50 overflow-hidden w-full h-auto rounded-md border border-gray-100 shadow-inner">
                            <img src="{{ asset($finalPhoto->photo_url) }}" alt="Final Strip" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                <div class="absolute bottom-5 left-0 w-full text-center">
                    <span class="text-text-main font-display uppercase tracking-widest text-sm font-bold">Photobooth</span>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="w-full md:w-1/2 flex flex-col gap-6 text-left">
            <div>
                <h3 class="text-2xl font-display font-semibold mb-2 text-text-main">Session: #{{ $session->session_code }}</h3>
                <p class="text-text-secondary leading-relaxed mb-6">Your digital artifact is ready. Download the high-fidelity strip or share it via a unique link.</p>
            </div>
            
            <a href="{{ route('download', $session->session_code) }}" class="btn-gradient px-6 py-3.5 rounded-full font-semibold flex justify-center items-center gap-2 text-white shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                Download artifact
            </a>
            
            <div class="grid grid-cols-2 gap-4">
                <button class="bg-white border border-gray-200 text-text-main hover:text-accent-pink hover:border-accent-pink/50 h-[48px] px-4 rounded-full font-semibold flex items-center justify-center gap-2 shadow-sm transition-all" onclick="alert('Copied to clipboard!')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                    Copy link
                </button>
                <button class="bg-white border border-gray-200 text-text-main hover:text-accent-pink hover:border-accent-pink/50 h-[48px] px-4 rounded-full font-semibold flex items-center justify-center gap-2 shadow-sm transition-all">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    QR Code
                </button>
            </div>
            
            <div class="mt-4 pt-6 border-t border-gray-200/60">
                <a href="{{ route('camera') }}" class="text-accent-pink hover:text-accent-rose font-medium text-sm flex items-center gap-1 transition-colors">
                    Start a new session
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
