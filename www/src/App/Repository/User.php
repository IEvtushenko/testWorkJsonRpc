<?php


namespace App\Repository;

use App\Db\Db;
use App\Helper\ModelMapper;
use App\Model\User as UserModel;
use App\Dto\LoginAuth as LoginAuthDto;

class User
{
    /**
     * @param LoginAuthDto $loginAuthDto
     *
     * @return UserModel|null
     */
    public function findOneByLoginPassword(LoginAuthDto $loginAuthDto): ?UserModel
    {
        $model = null;
        $userArray = Db::getRow(
            "SELECT * FROM user WHERE name = :name AND password = :password",
            ['name' => $loginAuthDto->getName(), 'password' => $loginAuthDto->getPassword()]);

        if (!empty($userArray)) {
            $model = new UserModel();
            ModelMapper::mapping($model, $userArray);
        }
        return $model;
    }
}