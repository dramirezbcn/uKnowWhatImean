<?php

namespace Application\UseCase\Board;

use Domain\Board\Model\Board;
use Domain\Board\Repository\BoardRepositoryInterface;

/**
 * Class BoardQuery
 * @package Application\UseCase\Board
 */
class BoardQuery
{
    /** @var BoardRepositoryInterface */
    private $boardRepository;

    /**
     * BoardCommand constructor.
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    /**
     * @param int $boardId
     * @return Board
     */
    public function getBoard(int $boardId): Board
    {
        return $this->boardRepository->getBoard($boardId);
    }
}