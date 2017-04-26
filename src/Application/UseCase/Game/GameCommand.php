<?php

namespace Application\UseCase\Game;

use Application\UseCase\Game\Request\CreateGameRequest;
use Application\UseCase\User\UserQuery;
use Domain\Game\Factory\GameFactoryInterface;
use Domain\Game\Model\Game;
use Domain\Game\Repository\GameRepositoryInterface;

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

    /**
     * GameCommand constructor.
     * @param GameFactoryInterface $gameFactory
     * @param GameRepositoryInterface $gameRepository
     * @param UserQuery $userQuery
     */
    public function __construct(
        GameFactoryInterface $gameFactory,
        GameRepositoryInterface $gameRepository,
        UserQuery $userQuery
    )
    {
        $this->gameFactory = $gameFactory;
        $this->gameRepository = $gameRepository;
        $this->userQuery = $userQuery;
    }

    /**
     * @param CreateGameRequest $createGameRequest
     * @return Game
     */
    public function create(CreateGameRequest $createGameRequest): Game
    {
        $firstUser = $this->userQuery->getUser($createGameRequest->getFirstUser());
        $secondUser = $this->userQuery->getUser($createGameRequest->getSecondUser());

        $game = $this->gameFactory->create($firstUser, $secondUser);
        $this->gameRepository->store($game);

        return $game;
    }
}