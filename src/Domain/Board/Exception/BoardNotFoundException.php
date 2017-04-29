<?php

namespace Domain\Board\Exception;

/**
 * Class BoardNotFoundException
 * @package Domain\Board\Exception
 */
class BoardNotFoundException extends \Exception
{
    /**
     * BoardNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = '')
{
    parent::__construct("board.exception.not.found:$message");
}
}
