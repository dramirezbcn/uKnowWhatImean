<?php

namespace Domain\Game\Exception;

/**
 * Class InvalidMovementException
 * @package Domain\Game\Exception
 */
class InvalidMovementException extends \Exception
{
    /**
     * InvalidMovementException constructor.
     * @param string $message
     */
    public function __construct($message = '')
{
    parent::__construct("game.exception.invalid.movement:$message");
}
}
