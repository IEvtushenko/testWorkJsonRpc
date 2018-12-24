<?php

namespace App\Helper\JsonRpc;

use App\Controller\LoginController;
use PhpJsonRpc\Server\MapperInterface;

class Mapper implements MapperInterface
{
    public function getClassAndMethod(string $requestedMethod): array
    {
        // Keys of array presents requested method
        $map = [
            'login.login' => [LoginController::class, 'login'],
        ];

        if (array_key_exists($requestedMethod, $map)) {
            return $map[$requestedMethod];
        }

        return ['', ''];
    }
}