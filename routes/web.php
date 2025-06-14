<?php

use App\Livewire\Frontend\AboutComponent;
use App\Livewire\Frontend\ContactComponent;
use App\Livewire\Frontend\HomeComponent;
use App\Livewire\Frontend\ServiceComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', HomeComponent::class);
Route::get('/about', AboutComponent::class)->name('about');
Route::get('/service', ServiceComponent::class)->name('service');
Route::get('/contact', ContactComponent::class)->name('contact');


require __DIR__.'/backend.php';
require __DIR__.'/jetstream.php';
require __DIR__.'/fortify.php';
