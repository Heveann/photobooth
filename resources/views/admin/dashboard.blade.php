@extends('layouts.admin')

@section('header_title', 'Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <!-- Stat Cards -->
    <div class="card-cream p-[24px]">
        <p class="text-[14px] text-body mb-2 font-medium">Total sessions</p>
        <h3 class="text-[36px] font-serif tracking-[-0.5px] text-ink">{{ \App\Models\PhotoSession::count() }}</h3>
    </div>
    
    <div class="card-cream p-[24px]">
        <p class="text-[14px] text-body mb-2 font-medium">Artifacts captured</p>
        <h3 class="text-[36px] font-serif tracking-[-0.5px] text-ink">{{ \App\Models\Photo::count() }}</h3>
    </div>
    
    <div class="card-cream p-[24px]">
        <p class="text-[14px] text-body mb-2 font-medium">Available templates</p>
        <h3 class="text-[36px] font-serif tracking-[-0.5px] text-ink">{{ \App\Models\Template::count() }}</h3>
    </div>
    
    <div class="card-dark p-[24px]">
        <div class="flex justify-between items-start mb-2">
            <p class="text-[14px] text-[#a09d96] font-medium">System status</p>
            <div class="w-2 h-2 rounded-full bg-[#5db872] mt-1.5"></div>
        </div>
        <h3 class="text-[36px] font-serif tracking-[-0.5px] text-[#faf9f5]">Operational</h3>
    </div>
</div>

<!-- Recent Sessions -->
<div class="card-cream border-hairline overflow-hidden">
    <div class="p-[24px] border-b border-hairline flex justify-between items-center bg-[#faf9f5]">
        <h2 class="text-[18px] font-medium text-ink">Recent artifacts</h2>
        <a href="{{ route('admin.photos.index') }}" class="text-[14px] text-primary font-medium hover:underline">View all</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-[14px] text-body">
            <thead class="bg-[#faf9f5] border-b border-hairline text-ink">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium">Session ID</th>
                    <th scope="col" class="px-6 py-4 font-medium">Date</th>
                    <th scope="col" class="px-6 py-4 font-medium">Frames</th>
                    <th scope="col" class="px-6 py-4 font-medium">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\PhotoSession::withCount('photos')->latest()->take(5)->get() as $session)
                <tr class="border-b border-hairline hover:bg-white/50 transition-colors">
                    <td class="px-6 py-4 font-mono text-[13px] text-ink">#{{ $session->session_code }}</td>
                    <td class="px-6 py-4">{{ $session->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $session->photos_count }}</td>
                    <td class="px-6 py-4">
                        @if($session->status == 'completed')
                            <span class="inline-flex items-center gap-1.5 text-[#5db872] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#5db872]"></span> Complete
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-[#d4a017] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#d4a017]"></span> Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="text-primary hover:text-primary-active font-medium">Inspect</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-muted">
                        No artifacts recorded in the system yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
