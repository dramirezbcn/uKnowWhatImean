<?php

namespace Application\UseCase\Board;

use Domain\Board\Factory\BoardFactoryInterface;
use Domain\Board\Model\Board;
use Domain\Board\Repository\BoardRepositoryInterface;

/**
 * Class BoardCommand
 * @package Application\UseCase\Board
 */
class BoardCommand
{
    /** @var BoardFactoryInterface  */
    private $boardFactory;

    /** @var BoardRepositoryInterface  */
    private $boardRepository;

    /**
     * BoardCommand constructor.
     * @param BoardFactoryInterface $boardFactory
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(
        BoardFactoryInterface $boardFactory,
        BoardRepositoryInterface $boardRepository
    )
    {
        $this->boardFactory = $boardFactory;
        $this->boardRepository = $boardRepository;
    }

    /**
     * @return Board
     */
    public function create(): Board
    {
        $board = $this->boardFactory->create();

        return $this->boardRepository->store($board);
    }
}