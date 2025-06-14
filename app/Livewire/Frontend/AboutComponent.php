<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AboutComponent extends Component
{
    #[Layout('frontend.layouts.app')]

    public function render()
    {
        return view('frontend.pages.about');
    }
}
