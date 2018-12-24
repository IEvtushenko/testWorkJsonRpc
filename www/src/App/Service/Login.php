<?php

namespace App\Service;

use App\Dto\LoginAuth as LoginAuthDto;
use App\Model\User as UserModel;
use App\Repository\User as UserRepository;
use PhpJsonRpc\Error\InvalidParamsException;

class Login
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Login constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginAuthDto $loginAuthDto
     *
     * @return bool|null
     * @throws InvalidParamsException
     */
    public function login(LoginAuthDto $loginAuthDto): ?bool
    {
        $userModel = $this->userRepository->findOneByLoginPassword($loginAuthDto);
        if (is_null($userModel)) {
            throw new InvalidParamsException('User Not Found');
        }
        return true;
    }
}