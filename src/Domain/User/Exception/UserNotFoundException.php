<?php

namespace Domain\User\Exception;

/**
 * Class UserNotFoundException
 * @package Domain\User\Exception
 */
class UserNotFoundException extends \Exception
{
    /**
     * UserNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = '')
{
    parent::__construct("user.exception.not.found:$message");
}
}
