<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AdminMiddleware extends Authenticate
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check() && $this->auth->user()->isAdmin && $this->auth->user()->type == 0) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }
}
