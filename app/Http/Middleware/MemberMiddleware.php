<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;

class MemberMiddleware extends Authenticate
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
            if ($this->auth->guard($guard)->check()) {
                $user = User::convert($this->auth->user());
                if ($user->isAdmin && $user->type == 0) {
                    $this->specialAccount($request, $guards);
                }
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function specialAccount($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, route('admin.main')
        );
    }


}
