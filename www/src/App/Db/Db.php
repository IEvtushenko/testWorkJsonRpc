<?php

namespace App\Db;

use PhpJsonRpc\Error\ServerErrorException;

class Db
{
    public static $dsn = 'mysql:host=25.25.0.2;dbname=testWork';
    public static $user = 'root';
    public static $pass = 'secret';

    /**
     * Объект PDO.
     */
    public static $Dbh = null;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * Выполняемый SQL запрос.
     */
    public static $query = '';

    /**
     * Подключение к БД
     */
    public static function getDbh()
    {
        if (!self::$Dbh) {
            try {
                self::$Dbh = new \PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass,
                    array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                self::$Dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            } catch (\PDOException $e) {
                exit('Error connecting to database: ' . $e->getMessage());
            }
        }
        $db = self::$Dbh;
        return $db;
    }

    /**
     * Добавление в таблицу, в случаи успеха вернет вставленный ID, иначе 0.
     */
    public static function add($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        return (self::execute((array)$param)) ? self::getDbh()->lastInsertId() : 0;
    }

    /**
     * Выполнение запроса.
     */
    public static function set($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        return self::execute((array)$param);
    }

    /**
     * Получение строки из таблицы.
     */
    public static function getRow($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::execute((array)$param);
        return self::$sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение всех строк из таблицы.
     */
    public static function getAll($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::execute((array)$param);
        return self::$sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение значения.
     */
    public static function getValue($query, $param = array(), $default = null)
    {
        $result = self::getRow($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }

        return (empty($result)) ? $default : $result;
    }

    /**
     * Получение столбца таблицы.
     */
    public static function getColumn($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::execute((array)$param);
        return self::$sth->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function execute(array $param)
    {
        $result = self::$sth->execute((array)$param);
        if (!$result) {
            throw new ServerErrorException('Not found datatable');
        }
        return $result;
    }
}