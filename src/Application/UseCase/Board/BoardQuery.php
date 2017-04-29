<?php

namespace Application\UseCase\Board;

use Domain\Board\Exception\BoardNotFoundException;
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
     * BoardQuery constructor.
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    /**
     * @param int $boardId
     * @return Board
     * @throws BoardNotFoundException
     */
    public function getBoard(int $boardId): Board
    {
        $board = $this->boardRepository->getBoard($boardId);

        if (null === $board) {
            throw new BoardNotFoundException($boardId);
        }

        return $board;
    }
}