<?php

namespace Domain\Board\Factory;

use Domain\Board\Model\Board;

/**
 * Interface BoardFactoryInterface
 * @package Domain\Board\Factory
 */
interface BoardFactoryInterface
{
    /**
     * @return Board
     */
    public function create(): Board;
}
