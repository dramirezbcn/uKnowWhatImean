<?php

namespace Application\UseCase\Game;

use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\Game\Request\MovementRequest;
use Application\UseCase\User\UserQuery;
use Domain\Board\Factory\BoardFactoryInterface;
use Domain\Game\Factory\GameFactoryInterface;
use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;
use Application\UseCase\Game\Dto\MovementDto;
use Domain\User\Model\User;

/**
 * Class GameCommand
 * @package Application\UseCase\Game
 */
class GameCommand
{
    /** @var GameFactoryInterface  */
    private $gameFactory;

    /** @var GameRepositoryInterface  */
    private $gameRepository;

    /** @var UserQuery  */
    private $userQuery;

    /** @var BoardFactoryInterface  */
    private $boardFactory;

    /**
     * GameCommand constructor.
     * @param GameFactoryInterface $gameFactory
     * @param GameRepositoryInterface $gameRepository
     * @param UserQuery $userQuery
     * @param BoardFactoryInterface $boardFactory
     */
    public function __construct(
        GameFactoryInterface $gameFactory,
        GameRepositoryInterface $gameRepository,
        UserQuery $userQuery,
        BoardFactoryInterface $boardFactory
    )
    {
        $this->gameFactory = $gameFactory;
        $this->gameRepository = $gameRepository;
        $this->userQuery = $userQuery;
        $this->boardFactory = $boardFactory;
    }

    /**
     * @param CreateGameRequest $createGameRequest
     * @return Game
     */
    public function create(CreateGameRequest $createGameRequest): Game
    {
        $firstUser = $this->userQuery->getUser($createGameRequest->getFirstUser());
        $secondUser = $this->userQuery->getUser($createGameRequest->getSecondUser());

        $board = $this->boardFactory->create();

        $game = $this->gameFactory->create($firstUser, $secondUser, $board);

        return $this->gameRepository->store($game);
    }

    /**
     * @param MovementRequest $movementRequest
     * @return Game
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

        $game = $this->gameRepository->getGame($movementRequest->getGame());

        $game->getBoard()->setMovement($movementDto);

        return $game;
    }

    /**
     * @param int $gameId
     * @return User
     */
    public function checkGameWinner(int $gameId): User
    {
        $game = $this->gameRepository->getGame($gameId);

        //check if there's a movements combination of the board that are winner
        //meanwhile it'll return a random user of the game

        if ((bool)random_int(0, 1)) {
            return $game->getFirstUser();
        }

        return $game->getSecondUser();
    }
}