<?php

namespace App\Libraries;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Mssql class
 */
class Mssql extends \PDO
{

    private static $_instance;

    /**
     * __construct function
     */
    private function __construct()
    {
        $dsn = 'sqlsrv:Server=LAPTOP-4JSVLNQ4;Database=Sventas';

        try {
            parent::__construct($dsn, 'DEVELOPER', 'mavesa22');
        } catch (\PDOException $e) {
            die("DataBase Error: Database failed.<br>{$e->getMessage()}");
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: Database failed.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        }
    }

    /**
     * getInstance function
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
            self::$_instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$_instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return self::$_instance;
    }

    public function InsertId()
    {
        return self::$_instance->lastInsertId();
    }
}
