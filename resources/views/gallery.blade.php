@extends('layouts.app')

@section('title', 'Gallery - Photobooth')

@section('content')
<div class="max-w-[1200px] mx-auto py-12">
    <div class="text-center mb-16 reveal-up">
        <h1 class="text-5xl font-display font-bold tracking-tight mb-4 text-text-main">Public Gallery</h1>
        <p class="text-lg text-text-secondary">Browse recent artifacts captured by the community.</p>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($sessions as $session)
            @if($session->photos->count() > 0)
            <div class="glass-card p-3 group hover:border-accent-pink/50 transition-all duration-300 relative reveal-up">
                <div class="bg-white/80 p-2 pb-8 rounded-xl border border-white relative shadow-sm group-hover:shadow-md transition-all">
                    <div class="grid grid-cols-1 gap-1">
                        @php $finalPhoto = $session->photos->where('is_final', true)->first() ?? $session->photos->first(); @endphp
                        @if($finalPhoto)
                            <div class="aspect-[1/3] bg-gray-100 overflow-hidden rounded-md border border-gray-100">
                                <img src="{{ asset($finalPhoto->photo_url) }}" alt="Final Strip" class="w-full h-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-105">
                            </div>
                        @endif
                    </div>
                    <div class="absolute bottom-2 w-full text-center left-0">
                        <span class="text-[9px] text-text-secondary font-display uppercase tracking-widest font-bold group-hover:text-accent-pink transition-colors">Photobooth</span>
                    </div>
                </div>
                
                <div class="absolute inset-0 bg-white/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-2xl backdrop-blur-sm">
                    <a href="{{ route('result', $session->session_code) }}" class="btn-gradient px-5 py-2.5 rounded-full text-[13px] font-semibold text-white shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all">View details</a>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-full text-center py-24 glass-card reveal-up">
                <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-pink-100 to-rose-100 text-accent-pink flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>
                <h3 class="text-2xl font-display font-semibold text-text-main mb-2">No artifacts found</h3>
                <p class="text-text-secondary mb-8">Be the first to create a photostrip in the gallery.</p>
                <a href="{{ route('camera') }}" class="btn-gradient text-white rounded-full px-8 py-3.5 font-semibold shadow-md hover:shadow-lg inline-block transition-all hover:-translate-y-1">Start session</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
