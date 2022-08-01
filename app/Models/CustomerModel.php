<?php

namespace App\Models;

use App\Entities\Customer;
use App\Libraries\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * CustomerModel class
 */
class CustomerModel
{

    private $table = 'customers';

    /**
     * findById function
     *
     * @param int $id
     * @return Customer
     */
    public function findById(int $id)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Customer::class);
            $Customer = $stmt->fetch();

            return $Customer;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Customer could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Customer could not be found.<br>{$e->getMessage()}");
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
     * findByEmail function
     *
     * @param string $email
     * @return Customer
     */
    public function findByEmail(string $email)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Customer::class);
            $Customer = $stmt->fetch();

            return $Customer;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Customer could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Customer could not be found.<br>{$e->getMessage()}");
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

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Customer::class);
            $Customers = $stmt->fetchAll();

            return $Customers;
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
     * @param Customer $Customer
     * @return bool
     */
    public function save(Customer $Customer)
    {
        $conn = Database::getInstance();

        try {
            $sql = "INSERT
                    INTO {$this->table}
                    (
                        nationality,
                        ci,
                        first_name,
                        last_name,
                        birth_date,
                        address,
                        phone,
                        email,
                        status
                    )
                    VALUES
                    (
                        :nationality,
                        :ci,
                        :first_name,
                        :last_name,
                        :birth_date,
                        :address,
                        :phone,
                        :email,
                        :status
                    )";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nationality', $Customer->nationality);
            $stmt->bindParam(':ci', $Customer->ci);
            $stmt->bindParam(':first_name', $Customer->first_name);
            $stmt->bindParam(':last_name', $Customer->last_name);
            $stmt->bindParam(':birth_date', $Customer->birth_date);
            $stmt->bindParam(':address', $Customer->address);
            $stmt->bindParam(':phone', $Customer->phone);
            $stmt->bindParam(':email', $Customer->email);
            $stmt->bindParam(':status', $Customer->status);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Customer could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Customer could not be saved.<br>{$e->getMessage()}");
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
     * @param Customer $Customer
     * @return bool
     */
    public function update(Customer $Customer)
    {
        $conn = Database::getInstance();

        try {
            $sql = "UPDATE {$this->table}
                    SET
                        nationality=:nationality,
                        ci=:ci,
                        first_name=:first_name,
                        last_name=:last_name,
                        birth_date=:birth_date,
                        address=:address,
                        phone=:phone,
                        email=:email,
                        status=:status
                    WHERE id=:id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nationality', $Customer->nationality);
            $stmt->bindParam(':ci', $Customer->ci);
            $stmt->bindParam(':first_name', $Customer->first_name);
            $stmt->bindParam(':last_name', $Customer->last_name);
            $stmt->bindParam(':birth_date', $Customer->birth_date);
            $stmt->bindParam(':address', $Customer->address);
            $stmt->bindParam(':phone', $Customer->phone);
            $stmt->bindParam(':email', $Customer->email);
            $stmt->bindParam(':status', $Customer->status);
            $stmt->bindParam(':id', $Customer->id);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Customer could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Customer could not be updated.<br>{$e->getMessage()}");
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
