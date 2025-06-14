<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

trait AuthorizeRequests
{

    /**
     * Summary of authorizeAccess
     * @param string $ability
     * @return void
     */
    protected function authorizeAccess(string $ability = "")
    {
        abort_if(Gate::denies(
            $this->resolveAbility($ability)
        ), Response::HTTP_FORBIDDEN);
    }

    /**
     * Authorize a specific action
     */
    public function verifyAuthorization(string $ability): void
    {
        abort_if(Gate::denies($ability), Response::HTTP_FORBIDDEN);
    }

    /**
     * Summary of getDefaultAbility
     * @return string
     */
    protected function getDefaultAbility(): string
    {
        return property_exists($this, 'defaultPermission')
            ? $this->defaultPermission
            : 'access';
    }

    /**
     * Summary of resolveAbility
     * @param mixed $ability
     * @return string
     */
    protected function resolveAbility(?string $ability = ""): string
    {
        return $ability ?? $this->getDefaultAbility();
    }
}