<?php

namespace App\Controller;

use App\Dto\LoginAuth;
use App\Repository\User as UserRepository;
use App\Service\Login as LoginService;

class LoginController
{
    /**
     * @param string $name
     * @param string $password
     *
     * @return bool|null
     * @throws \PhpJsonRpc\Error\InvalidParamsException
     */
    public function login(string $name, string $password): ?bool
    {
        $loginAuthDto = new LoginAuth($name, $password);
        $service = new LoginService(new UserRepository());//di
        $result = $service->login($loginAuthDto);
        return $result;
    }
}