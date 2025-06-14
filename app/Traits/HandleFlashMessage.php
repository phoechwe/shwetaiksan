<?php

namespace App\Traits;

trait HandleFlashMessage {

    /**
     * Ouput flash message
     * @param string $message
     * @param string $type
     * @return void
     */
    protected function flashMessage(string $message, string $type = ''): void
    {
        session()->flash('message', $message);
        session()->flash('type', $type);
    }
}