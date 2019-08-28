<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenException;
use App\Exceptions\TokenException;
use App\Http\Enum\ScopeEnum;
use Closure;
use App\Http\Service\Token as TokenService;

class CheckPrimaryScope
{
    /*
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    //用户和CMS管理员都可以访问的权限
    public function handle($request, Closure $next)
    {
        $scope = TokenService::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return $next($request);
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }
}
