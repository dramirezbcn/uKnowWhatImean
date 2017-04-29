<?php

namespace Domain\Game\Exception;

/**
 * Class GameNotFoundException
 * @package Domain\Game\Exception
 */
class GameNotFoundException extends \Exception
{
    /**
     * GameNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = '')
{
    parent::__construct("game.exception.not.found:$message");
}
}
