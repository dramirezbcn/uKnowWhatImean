<?php

namespace Domain\Game\Model;

use Domain\Board\Model\Board;
use Domain\User\Model\User;

/**
 * Class Game
 */
class Game
{
    /** @var  int */
    private $id;

    /** @var  User */
    private $firstUser;

    /** @var  User */
    private $secondUser;

    /** @var  Board */
    private $board;

    /** @var  \DateTime */
    private $createdAt;

    /** @var  \DateTime */
    private $updatedAt;

    /**
     * Game constructor.
     * @param User $firstUser
     * @param User $secondUser
     * @param Board $board
     */
    public function __construct(User $firstUser, User $secondUser, Board $board)
    {
        $this->firstUser = $firstUser;
        $this->secondUser = $secondUser;
        $this->board = $board;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getFirstUser(): User
    {
        return $this->firstUser;
    }

    /**
     * @return User
     */
    public function getSecondUser(): User
    {
        return $this->secondUser;
    }

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Game
     */
    public function setUpdatedAt(\DateTime $updatedAt): Game
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}