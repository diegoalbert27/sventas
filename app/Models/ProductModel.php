<?php

namespace App\Models;

use App\Entities\Product;
use App\Libraries\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * ProductModel class
 */
class ProductModel
{

    private $table = 'products';

    public $last_insert_id = null;

    /**
     * findById function
     *
     * @param int $id
     * @return Product
     */
    public function findById(int $id)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Product::class);
            $Product = $stmt->fetch();

            return $Product;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Product could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Product could not be found.<br>{$e->getMessage()}");
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

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Product::class);
            $Products = $stmt->fetchAll();

            return $Products;
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

    /**
     * save function
     *
     * @param Product $Product
     * @return bool
     */
    public function save(Product $Product)
    {
        $conn = Database::getInstance();

        try {
            $sql = "INSERT
                    INTO {$this->table}
                    (
                        code,
                        reference,
                        type_product,
                        name,
                        pvp,
                        badge,
                        category,
                        status,
                        provider
                    )
                    VALUES
                    (
                        :code,
                        :reference,
                        :type_product,
                        :name,
                        :pvp,
                        :badge,
                        :category,
                        :status,
                        :provider
                    )";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':code', $Product->code);
            $stmt->bindParam(':reference', $Product->reference);
            $stmt->bindParam(':type_product', $Product->type_product);
            $stmt->bindParam(':name', $Product->name);
            $stmt->bindParam(':pvp', $Product->pvp);
            $stmt->bindParam(':badge', $Product->badge);
            $stmt->bindParam(':category', $Product->category);
            $stmt->bindParam(':status', $Product->status);
            $stmt->bindParam(':provider', $Product->provider);
            $result = $stmt->execute();

            if ($result) {
                $this->last_insert_id = $conn->InsertId();
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Product could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Product could not be saved.<br>{$e->getMessage()}");
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
     * @param Product $Product
     * @return bool
     */
    public function update(Product $Product)
    {
        $conn = Database::getInstance();

        try {
            $sql = "UPDATE {$this->table}
                    SET
                        code=:code,
                        reference=:reference,
                        type_product=:type_product,
                        name=:name,
                        pvp=:pvp,
                        badge=:badge,
                        category=:category,
                        status=:status,
                        provider=:provider
                    WHERE id=:id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':code', $Product->code);
            $stmt->bindParam(':reference', $Product->reference);
            $stmt->bindParam(':type_product', $Product->type_product);
            $stmt->bindParam(':name', $Product->name);
            $stmt->bindParam(':pvp', $Product->pvp);
            $stmt->bindParam(':badge', $Product->badge);
            $stmt->bindParam(':category', $Product->category);
            $stmt->bindParam(':status', $Product->status);
            $stmt->bindParam(':provider', $Product->provider);
            $stmt->bindParam(':id', $Product->id);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Product could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Product could not be updated.<br>{$e->getMessage()}");
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
