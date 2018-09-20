<?php
/**
 *
 * User: aitspeko
 * Date: 19/09/2018
 * Time: 16:52
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA;


use PragmaRX\Google2FALaravel\Events\OneTimePasswordExpired;

class TwoFactorAuthenticator
{
        protected function twoFactorAuthStillValid()
        {
                $token = \request()->user()->Token();
                return
                    (bool)$token->twofactor_verified &&
                    !$this->passwordExpired();
        }

        protected function passwordExpired()
        {
                if (($minutes = $this->config('lifetime')) !== 0 && $this->minutesSinceLastActivity() > $minutes) {
                        event(new OneTimePasswordExpired($this->getUser()));

                        $this->logout();

                        return true;
                }

                // $this->keepAlive();

                return false;
        }
}