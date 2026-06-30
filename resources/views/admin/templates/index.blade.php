@extends('layouts.admin')

@section('header_title', 'Manage Templates')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">Template Frames</h2>
        <button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary/90">Add New Template</button>
    </div>
    
    <div class="text-center py-12 text-gray-500">
        Template management implementation goes here.
    </div>
</div>
@endsection
