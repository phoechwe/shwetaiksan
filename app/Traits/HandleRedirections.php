<?php

namespace App\Traits;

trait HandleRedirections
{


    /**
     * Redirect to specific route
     * @param string $route
     */
    protected function redirectTo(string $route)
    {
        // dd($route);
        return redirect()->route(str_replace("/", ".", $route));
    }
}