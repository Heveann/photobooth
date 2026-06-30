@extends('layouts.app')

@section('title', 'Gallery - Photobooth')

@section('content')
<div class="max-w-[1200px] mx-auto py-12">
    <div class="text-center mb-16 reveal-up">
        <h1 class="text-5xl font-display font-bold tracking-tight mb-4 text-text-main">Public Gallery</h1>
        <p class="text-lg text-text-secondary">Browse recent artifacts captured by the community.</p>
    </div>
    
    @if(session('success'))
        <div class="max-w-2xl mx-auto mb-10 bg-green-50/80 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-3 backdrop-blur-sm reveal-up">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($sessions as $session)
            @if($session->photos->count() > 0)
            <div class="glass-card p-3 group hover:border-accent-pink/50 transition-all duration-300 relative reveal-up">
                
                <!-- Delete Button -->
                <form action="{{ route('gallery.destroy', $session->id) }}" method="POST" class="absolute -top-3 -right-3 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" onsubmit="return confirm('Are you sure you want to delete this photo session?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-8 h-8 bg-white border border-red-100 text-red-500 rounded-full flex items-center justify-center shadow-lg hover:bg-red-50 hover:scale-110 transition-all" title="Delete Photo">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </form>

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
