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
     * @param int $boardSize
     * @return Board
     */
    public function create(int $boardSize): Board;
}
