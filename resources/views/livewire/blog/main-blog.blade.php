@extends('layouts.app')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <a href="{{ route('home') }}">
        <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
    </a>
</div>

<section class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 style="text-align: center;">{{ $welcome }}</h2>
    <livewire:blog />
</section>
