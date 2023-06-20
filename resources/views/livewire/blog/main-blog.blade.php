@extends('layouts.app')

<div class="p-6 text-left sm:fixed sm:top-0 sm:left-0">
    Roles Spatie:
    @if(auth()->user()->can('read articles'))
        <x-button rounded info label="Read" />
    @endif

    @role('admin')
        <x-button rounded info label="Edit" />
        <x-button rounded info label="Write" />
        <x-button rounded info label="Delete" />
    @endrole
    
</div>

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <a href="{{ route('home') }}">
        <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
    </a>
</div>

<section class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 style="text-align: center;">{{ $welcome }}</h2>
    <livewire:blog />
</section>
