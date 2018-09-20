<?php
/**
 *
 * User: aitspeko
 * Date: 20/09/2018
 * Time: 11:28
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA\Events;


class TwoFactorDisabledEvent extends Event
{
        /**
         * @var mixed
         */
        protected $user;

        /**
         * TwoFactorActivatedEvent constructor.
         *
         * @param $user mixed User that caused the event
         */
        public function __construct($user)
        {
                $this->user = $user;
        }

        /**
         * Return the user that caused the event
         *
         * @return mixed
         */
        public function getUser()
        {
                return $this->user;
        }
}