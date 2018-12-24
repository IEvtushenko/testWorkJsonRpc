<?php


namespace App\Dto;


class LoginAuth
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $password;

    /**
     * LoginAuth constructor.
     *
     * @param string $name
     * @param string $password
     */
    public function __construct(string $name, string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}