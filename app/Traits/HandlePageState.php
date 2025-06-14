<?php

namespace App\Traits;

trait HandlePageState
{

    /**
     * handle current page state
     * @param array $routes
     * @return void
     */
    protected function determineCurrentPage(array $routeMap): void
    {
        foreach ($routeMap as $route => $action) {
            if (request()->is($route)) {
                $this->handlePageAction($action, request()->route('id'));
                return;
            }
        }
        $this->currentPage = $this->defaultPage ?? 'list';
    }
    
    protected function handlePageAction(string $action, $id = null): void
    {
        $this->currentPage = $action;

        if (method_exists($this, $action)) {
            $id ? $this->{$action}($id) : $this->{$action}();
        }
    }
}