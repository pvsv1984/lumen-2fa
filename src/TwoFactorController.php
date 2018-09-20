<?php
/**
 *
 * User: aitspeko
 * Date: 19/09/2018
 * Time: 17:36
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lshtmweb\Lumen2FA\Events\TwoFactorActivatedEvent;
use Lshtmweb\Lumen2FA\Events\TwoFactorBeforeDisableEvent;
use Lshtmweb\Lumen2FA\Events\TwoFactorDisabledEvent;
use Lshtmweb\Lumen2FA\Events\TwoFactorInfoGeneratedEvent;
use PragmaRX\Google2FALaravel\Events\LoginFailed;
use PragmaRX\Google2FALaravel\Events\LoginSucceeded;
use PragmaRX\Google2FALaravel\Exceptions\InvalidOneTimePassword;
use PragmaRX\Google2FALaravel\Facade as Google2FA;

class TwoFactorController
{
        /**
         * @var \Illuminate\Contracts\Auth\Authenticatable|null|TwoFactorUserTrait
         */
        protected $auth_user;

        public function __construct()
        {
                $this->auth_user = Auth::user();
        }

        /**
         * @param Request $request
         *
         * @return mixed
         */
        public function disableUser2FA(Request $request)
        {
                $this->validate($request, [
                    'user' => 'required'
                ]);
                $userClass = config('auth.providers.users.model');
                $user = (new $userClass)->retrieveUserByIdentifier($request->user);
                event(new TwoFactorBeforeDisableEvent($this->auth_user, $user));
                $user->clearTwofactorSecret();
                $user->save();

                return $user;

        }

        /**
         * @param Request $request
         *
         * @throws InvalidOneTimePassword
         */
        public function verify2FA(Request $request)
        {
                $this->validate($request, [
                    'code' => 'required'
                ]);
                $token = $request->user()->Token();
                $valid = Google2FA::verifyGoogle2FA($this->auth_user->twofactor_secret, $request->code);
                if (!$valid) {
                        $token->twofactor_verified = false;
                        $token->save();
                        event(new LoginFailed($this->auth_user));
                        throw new InvalidOneTimePassword("Unable to verify your code");
                }
                $token->twofactor_verified = true;
                $token->save();
                event(new LoginSucceeded($this->auth_user));
        }

        /**
         * @param Request $request
         *
         * @return void
         * @throws InvalidOneTimePassword
         */
        public function disable2FA(Request $request)
        {
                $this->validate($request, [
                    'code' => 'required'
                ]);
                $token = $request->user()->Token();
                $valid = Google2FA::verifyGoogle2FA($this->auth_user->twofactor_secret, $request->code);
                if ($valid) {
                        $this->auth_user->twofactor_secret = null;
                        $this->auth_user->save();
                        $token->twofactor_verified = false;
                        $token->save();
                        event(new TwoFactorDisabledEvent($this->auth_user));
                } else {
                        event(new LoginFailed($this->auth_user));
                        throw new InvalidOneTimePassword("Unable to verify your code");
                }
                event(new LoginSucceeded($this->auth_user));
        }

        /**
         * @return array
         */
        public function show2FARegistrationInfo()
        {
                $secret = Google2FA::generateSecretKey(config('lumen2fa.key_length', 32));
                $QR_Image = Google2FA::getQRCodeInline(
                    config('lumen2fa.app_name', 'Secure App'),
                    $this->auth_user->{config('lumen2fa.user_identified_field')},
                    $secret
                );
                $data = [
                    "image" => $QR_Image,
                    "code"  => $secret
                ];
                event(new TwoFactorInfoGeneratedEvent($data, $this->auth_user));

                return $data;
        }

        public function activate2FA(Request $request)
        {
                $this->validate($request, [
                    'secret' => 'required'
                ]);
                $user = Auth::user();
                $secretKey = $request->secret;
                $user->twofactor_secret =
                    str_pad($secretKey, pow(2, ceil(log(strlen($secretKey), 2))), config('lumen2fa.string_pad', 'X'));
                $user->save();
                event(new TwoFactorActivatedEvent($user));
        }
}