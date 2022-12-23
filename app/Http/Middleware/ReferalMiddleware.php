<?php

namespace App\Http\Middleware;

use App\Models\Referal;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ReferalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($request->referal_code))
        {
            $user = User::where('code', $request->referal_code)->first();
            if(isset($user))
            {
                Referal::create([
                    'ip' => $request->getClientIp(),
                    'user_id' => $user->id,
                ]);
            }
        }

        return $next($request);
    }
}
