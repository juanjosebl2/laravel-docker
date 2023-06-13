@extends('layouts.app')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <a href="{{ route('home') }}">
        <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
    </a>
</div>

<section class="flex flex-col items-center space-y-4 py-12">
    
    <livewire:blog />
</section>
