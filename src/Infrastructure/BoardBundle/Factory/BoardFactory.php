<?php

namespace Infrastructure\BoardBundle\Factory;

use Domain\Board\Model\Board;
use Domain\Board\Factory\BoardFactoryInterface;

/**
 * Class BoardFactory
 * @package Infrastructure\BoardBundle\Factory
 */
class BoardFactory implements BoardFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(): Board
    {
        return new Board();
    }
}