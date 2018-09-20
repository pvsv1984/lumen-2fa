<?php
/**
 *
 * User: aitspeko
 * Date: 19/09/2018
 * Time: 16:51
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA;


use Closure;
use Illuminate\Http\Response;

class TwoFactorCheckMiddleware
{
        public function handle($request, Closure $next)
        {
                $authenticator = app(TwoFactorAuthenticator::class)->boot($request);

                if ($authenticator->isAuthenticated()) {
                        return $next($request);
                }

                return abort(Response::HTTP_OK, "Please verify 2FA before continuing");
        }
}