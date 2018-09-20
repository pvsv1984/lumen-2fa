<?php
/**
 *
 * User: aitspeko
 * Date: 20/09/2018
 * Time: 10:36
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA;


use LaravelClasses\Traits\UUIDGenerate;

/**
 * Trait TwoFactorUserTrait
 *
 * @package Lshtmweb\Lumen2FA
 * @property string twofactor_secret
 */
trait TwoFactorUserTrait
{
        use UUIDGenerate;
        /**
         * Check if user has two factor enabled
         *
         * @return bool
         */
        public function hasTwoFactorEnabled()
        {
                return !empty($this->twofactor_secret);
        }

        /**
         * Clear the secret from user profile.
         */
        public function clearTwofactorSecret()
        {
                $this->attributes['twofactor_secret'] = null;
        }


        /**
         * Setter for secret
         *
         * @param $value
         */
        public function setTwofactorSecretAttribute($value)
        {
                $this->attributes['twofactor_secret'] = encrypt($value);
        }

        /**
         * Getter for secret
         *
         * @param $value
         *
         * @return string
         */
        public function getTwofactorSecretAttribute($value)
        {
                if (!empty($value)) {
                        return decrypt($value);
                }

                return $value;
        }

        public function retrieveUserByIdentifier($value)
        {
                return $this->referenceOrFail($value);
        }
}