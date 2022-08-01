<?php

namespace App\Models;

use App\Entities\Stock;
use App\Libraries\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * StockModel class
 */
class StockModel
{

    private $table = 'stocks';

    /**
     * findById function
     *
     * @param int $id
     * @return Stock
     */
    public function findById(int $id)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Stock::class);
            $stock = $stmt->fetch();

            return $stock;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Stock could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Stock could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } finally {
            // Destroy the database connection
            $conn = null;
        }
    }

    /**
     * findById function
     *
     * @param int $product
     * @return Stock
     */
    public function findByProduct(int $product)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE product = :product;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product', $product);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Stock::class);
            $stock = $stmt->fetch();

            return $stock;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Stock could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Stock could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } finally {
            // Destroy the database connection
            $conn = null;
        }
    }

    /**
     * findAll function
     *
     * @return array
     */
    public function findAll()
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table};";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Stock::class);
            $stocks = $stmt->fetchAll();

            return $stocks;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: No results were obtained.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: No results were obtained.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } finally {
            // Destroy the database connection
            $conn = null;
        }
    }

    public function save(Stock $stock)
    {
        $conn = Database::getInstance();

        try {
            $sql = "INSERT
                    INTO {$this->table}
                    (
                        product,
                        stock
                    )
                    VALUES
                    (
                        :product,
                        :stock
                    )";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':product', $stock->product);
            $stmt->bindParam(':stock', $stock->stock);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The stock could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The stock could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } finally {
            // Destroy the database connection
            $conn = null;
        }
    }

    /**
     * update function
     *
     * @param Stock $Stock
     * @return bool
     */
    public function update(Stock $stock)
    {
        $conn = Database::getInstance();

        try {
            $sql = "UPDATE {$this->table}
                    SET
                        product = :product,
                        stock = :stock
                    WHERE id = :id;";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $stock->id);
            $stmt->bindParam(':stock', $stock->stock);
            $stmt->bindParam(':product', $stock->product);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The stock could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The stock could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } finally {
            // Destroy the database connection
            $conn = null;
        }
    }
}
