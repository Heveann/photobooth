@extends('layouts.app')

@section('title', 'Sign In - Photobooth')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center w-full max-w-md mx-auto relative z-10 reveal-up">
    <div class="mb-8 text-center flex flex-col items-center">
        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-accent-pink to-accent-rose flex items-center justify-center text-white mb-6 shadow-md shadow-pink-200">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
        </div>
        <h1 class="text-4xl font-display font-bold text-text-main tracking-tight">Welcome Back</h1>
        <p class="text-text-secondary mt-2">Sign in to your account</p>
    </div>

    <div class="w-full glass-card p-10 reveal-up delay-100 shadow-xl">
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-xl text-sm font-medium border border-red-100 flex items-start gap-3">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="flex-shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <div>
                <label class="block text-sm font-semibold text-text-main mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-text-secondary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full h-[52px] pl-11 pr-4 rounded-xl bg-white/60 border border-gray-200 text-text-main text-[15px] focus:bg-white focus:border-accent-pink focus:ring-2 focus:ring-pink-100 focus:outline-none transition-all placeholder-gray-400" 
                        placeholder="hello@example.com">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-text-main mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-text-secondary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <input type="password" name="password" required
                        class="w-full h-[52px] pl-11 pr-4 rounded-xl bg-white/60 border border-gray-200 text-text-main text-[15px] focus:bg-white focus:border-accent-pink focus:ring-2 focus:ring-pink-100 focus:outline-none transition-all placeholder-gray-400" 
                        placeholder="••••••••">
                </div>
            </div>
            
            <div class="pt-2">
                <button type="submit" class="w-full btn-gradient h-[52px] rounded-xl text-white font-semibold text-base shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Sign In
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </div>
        </form>
    </div>
    
    <div class="mt-8 reveal-up delay-200">
        <a href="{{ route('home') }}" class="text-text-secondary hover:text-accent-pink text-sm font-medium transition-colors flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Home
        </a>
    </div>
</div>
@endsection
