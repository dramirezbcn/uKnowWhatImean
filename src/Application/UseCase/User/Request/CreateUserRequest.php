<?php

namespace Application\UseCase\User\Request;

/**
 * Class CreateUserRequest
 * @package Application\UseCase\User\Request
 */
class CreateUserRequest
{
    /** @var  string */
    private $name;

    /**
     * CreateUserRequest constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}