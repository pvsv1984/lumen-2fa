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


class TwoFactorBeforeDisableEvent extends Event
{
        /**
         * @var mixed
         */
        protected $authUser;
        protected $user;

        /**
         * TwoFactorBeforeDisableEvent constructor.
         *
         * @param $authUser
         * @param $user
         */
        public function __construct($authUser, $user)
        {
                $this->authUser = $authUser;
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

        /**
         * User trying to disable
         *
         * @return mixed
         */
        public function getAuthUser()
        {
                return $this->authUser;
        }
}