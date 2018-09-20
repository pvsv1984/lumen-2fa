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


class TwoFactorInfoGeneratedEvent extends Event
{
        /**
         * @var mixed
         */
        protected $vars;

        protected $user;

        /**
         * TwoFactorInfoGeneratedEvent constructor.
         *
         * @param $vars
         * @param $user
         */
        public function __construct($vars, $user)
        {
                $this->vars = $vars;

                $this->user = $user;
        }

        /**
         * Return the user that caused the event
         *
         * @return mixed
         */
        public function getVars()
        {
                return $this->vars;
        }

        /**
         * Getter for code
         *
         * @return mixed
         */
        public function getCode()
        {
                return $this->vars['code'];
        }

        /**
         * Getter for image
         *
         * @return mixed
         */
        public function getImage()
        {
                return $this->vars['image'];
        }

        /**
         * Getter for user
         *
         * @return mixed
         */
        public function getUser()
        {
                return $this->user;
        }
}