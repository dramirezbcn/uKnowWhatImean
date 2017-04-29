<?php

namespace Domain\Board\Repository;

use Domain\Board\Model\Board;

/**
 * Class BoardRepositoryInterface
 * @package Domain\Board\Repository
 */
interface BoardRepositoryInterface
{
    /**
     * @param Board $board
     * @return Board
     */
    public function store(Board $board): Board;

    /**
     * @param int $boardId
     * @return Board|null
     */
    public function getBoard(int $boardId);
}