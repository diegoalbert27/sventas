<?php

namespace App\Models;

use App\Entities\Factura;
use App\Libraries\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * FacturaModel class
 */
class FacturaModel
{

    private $table = 'facturas';

    /**
     * findById function
     *
     * @param int $id
     * @return factura
     */
    public function findById(int $id)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Factura::class);
            $factura = $stmt->fetch();

            return $factura;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Factura could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Factura could not be found.<br>{$e->getMessage()}");
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

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Factura::class);
            $facturas = $stmt->fetchAll();

            return $facturas;
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

    public function save(Factura $factura)
    {
        $conn = Database::getInstance();

        try {
            $sql = "INSERT
                    INTO {$this->table}
                    (
                        factura,
                        product,
                        client,
                        amount,
                        mount,
                        date_created
                    )
                    VALUES
                    (
                        :factura,
                        :product,
                        :client,
                        :amount,
                        :mount,
                        :date_created
                    )";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':factura', $factura->factura);
            $stmt->bindParam(':product', $factura->product);
            $stmt->bindParam(':client', $factura->client);
            $stmt->bindParam(':amount', $factura->amount);
            $stmt->bindParam(':mount', $factura->mount);
            $stmt->bindParam(':date_created', $factura->date_created);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The factura could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The factura could not be saved.<br>{$e->getMessage()}");
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
     * @param Factura $factura
     * @return bool
     */
    public function update(Factura $factura)
    {
        $conn = Database::getInstance();

        try {
            $sql = "UPDATE {$this->table}
                    SET
                        factura = :factura,
                        product = :product,
                        client = :client,
                        amount = :amount,
                        date_created = :date_created
                    WHERE id = :id;";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $factura->id);
            $stmt->bindParam(':factura', $factura->factura);
            $stmt->bindParam(':product', $factura->product);
            $stmt->bindParam(':client', $factura->client);
            $stmt->bindParam(':amount', $factura->amount);
            $stmt->bindParam(':mount', $factura->mount);
            $stmt->bindParam(':date_created', $factura->date_created);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The factura could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The factura could not be updated.<br>{$e->getMessage()}");
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
