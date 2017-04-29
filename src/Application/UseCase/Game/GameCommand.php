<?php

namespace Application\UseCase\Game;

use Application\UseCase\Board\BoardCommand;
use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\Request\MovementRequest;
use Application\UseCase\User\UserQuery;
use Domain\Game\Exception\GameNotFoundException;
use Domain\Game\Exception\InvalidMovementException;
use Domain\Game\Factory\GameFactoryInterface;
use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;
use Application\UseCase\Game\Dto\MovementDto;
use Domain\User\Exception\UserNotFoundException;
use Domain\User\Model\User;

/**
 * Class GameCommand
 * @package Application\UseCase\Game
 */
class GameCommand
{
    /** @var GameFactoryInterface */
    private $gameFactory;

    /** @var GameRepositoryInterface */
    private $gameRepository;

    /** @var UserQuery */
    private $userQuery;

    /** @var BoardCommand */
    private $boardCommand;

    /** @var GameQuery */
    private $gameQuery;

    /**
     * GameCommand constructor.
     * @param GameFactoryInterface $gameFactory
     * @param GameRepositoryInterface $gameRepository
     * @param UserQuery $userQuery
     * @param BoardCommand $boardCommand
     * @param GameQuery $gameQuery
     */
    public function __construct(
        GameFactoryInterface $gameFactory,
        GameRepositoryInterface $gameRepository,
        UserQuery $userQuery,
        BoardCommand $boardCommand,
        GameQuery $gameQuery
    )
    {
        $this->gameFactory = $gameFactory;
        $this->gameRepository = $gameRepository;
        $this->userQuery = $userQuery;
        $this->boardCommand = $boardCommand;
        $this->gameQuery = $gameQuery;
    }

    /**
     * @param CreateGameRequest $createGameRequest
     * @return Game
     * @throws UserNotFoundException
     */
    public function create(CreateGameRequest $createGameRequest): Game
    {
        $firstUser = $this->userQuery->getUser($createGameRequest->getFirstUser());
        $secondUser = $this->userQuery->getUser($createGameRequest->getSecondUser());

        $board = $this->boardCommand->create($createGameRequest->getBoardSize());

        $game = $this->gameFactory->create($firstUser, $secondUser, $board);

        return $this->gameRepository->store($game);
    }

    /**
     * @param MovementRequest $movementRequest
     * @return Game
     * @throws InvalidMovementException|UserNotFoundException|GameNotFoundException
     */
    public function makeMovement(MovementRequest $movementRequest): Game
    {
        $user = $this->userQuery->getUser($movementRequest->getUser());

        $movementDto = new MovementDto(
            $movementRequest->getPositionX(),
            $movementRequest->getPositionY(),
            $movementRequest->getType(),
            $user
        );

        $game = $this->gameQuery->getGame($movementRequest->getGame());

        if ($this->checkMovementAvailability($movementDto, $game)) {
            $this->boardCommand->update($game->getBoard()->setMovement($movementDto));
            $this->gameRepository->store($game);
        }

        return $game;
    }

    /**
     * @param MovementDto $movementDto
     * @param Game $game
     * @return bool
     * @throws InvalidMovementException
     */
    private function checkMovementAvailability(MovementDto $movementDto, Game $game): bool
    {
        if ($movementDto->getPositionX() > $game->getBoard()->getBoardSize()
            || $movementDto->getPositionY() > $game->getBoard()->getBoardSize()
        ) {
            throw new InvalidMovementException('Position bigger than board size.');
        }

        if ($game->getBoard()
                ->getBoardPositions()[$movementDto->getPositionX()][$movementDto->getPositionY()]
                ->getType() !== MovementDto::blank
        ) {
            throw new InvalidMovementException('Position already used.');
        }

        return true;
    }

    /**
     * @param int $gameId
     * @return User|bool
     * @throws GameNotFoundException
     */
    public function checkGameWinnerOrOver(int $gameId)
    {
        $game = $this->gameQuery->getGame($gameId);

        $boardPositions = $game->getBoard()->getBoardPositions();

        //[row1, row2, row3, col1, col2, col3, diag1, diag2]
        $winnerScore = array_fill(0, $game->getBoard()->getBoardSize() * 2 + 2, 0);
        $totalMovements = 0;

        /** @var MovementDto[] $row */
        foreach ($boardPositions as $row) {
            /** @var MovementDto $movement */
            foreach ($row as $movement) {
                if (null !== $movement->getUser()) {
                    $score = ($movement->getUser() === $game->getFirstUser() ? 1 : -1);
                    $winnerScore[$movement->getPositionX()] += $score;
                    $winnerScore[$game->getBoard()->getBoardSize() + $movement->getPositionY()] += $score;
                    if ($movement->getPositionX() === $movement->getPositionY()) {
                        $winnerScore[2 * $game->getBoard()->getBoardSize()] += $score;
                    }
                    if ($movement->getPositionX() + $movement->getPositionY() === $game->getBoard()->getBoardSize() - 1) {
                        $winnerScore[2 * $game->getBoard()->getBoardSize() + 1] += $score;
                    }
                    $totalMovements++;
                }
            }
        }

        if (in_array(3, $winnerScore, true)) {
            return $game->getFirstUser();
        } elseif (in_array(-3, $winnerScore, true)) {
            return $game->getSecondUser();
        } elseif ($totalMovements === $game->getBoard()->getBoardSize() * $game->getBoard()->getBoardSize()) {
            return true;
        }

        return false;
    }
}