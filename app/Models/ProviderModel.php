<?php

namespace App\Models;

use App\Entities\Provider;
use App\Libraries\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * ProviderModel class
 */
class ProviderModel
{

    private $table = 'providers';

    /**
     * findById function
     *
     * @param int $id
     * @return Provider
     */
    public function findById(int $id)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Provider::class);
            $Provider = $stmt->fetch();

            return $Provider;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Provider could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Provider could not be found.<br>{$e->getMessage()}");
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
     * @return Provider
     */
    public function findByEmail(string $email)
    {
        $conn = Database::getInstance();

        try {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Provider::class);
            $Provider = $stmt->fetch();

            return $Provider;
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Provider could not be found.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Provider could not be found.<br>{$e->getMessage()}");
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

            $stmt->setFetchMode(\PDO::FETCH_CLASS, Provider::class);
            $Providers = $stmt->fetchAll();

            return $Providers;
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
     * @param Provider $Provider
     * @return bool
     */
    public function save(Provider $Provider)
    {
        $conn = Database::getInstance();

        try {
            $sql = "INSERT
                    INTO {$this->table}
                    (
                        reference,
                        name,
                        company,
                        address,
                        phone,
                        rif,
                        email,
                        origin,
                        status
                    )
                    VALUES
                    (
                        :reference,
                        :name,
                        :company,
                        :address,
                        :phone,
                        :rif,
                        :email,
                        :origin,
                        :status
                    )";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':reference', $Provider->reference);
            $stmt->bindParam(':name', $Provider->name);
            $stmt->bindParam(':company', $Provider->company);
            $stmt->bindParam(':address', $Provider->address);
            $stmt->bindParam(':phone', $Provider->phone);
            $stmt->bindParam(':rif', $Provider->rif);
            $stmt->bindParam(':email', $Provider->email);
            $stmt->bindParam(':origin', $Provider->origin);
            $stmt->bindParam(':status', $Provider->status);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Provider could not be saved.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Provider could not be saved.<br>{$e->getMessage()}");
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
     * @param Provider $Provider
     * @return bool
     */
    public function update(Provider $Provider)
    {
        $conn = Database::getInstance();

        try {
            $sql = "UPDATE {$this->table}
                    SET
                        reference=:reference,
                        name=:name,
                        company=:company,
                        address=:address,
                        phone=:phone,
                        rif=:rif,
                        email=:email,
                        origin=:origin,
                        status=:status
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $Provider->id);
            $stmt->bindParam(':reference', $Provider->reference);
            $stmt->bindParam(':rif', $Provider->rif);
            $stmt->bindParam(':name', $Provider->name);
            $stmt->bindParam(':company', $Provider->company);
            $stmt->bindParam(':origin', $Provider->origin);
            $stmt->bindParam(':address', $Provider->address);
            $stmt->bindParam(':phone', $Provider->phone);
            $stmt->bindParam(':email', $Provider->email);
            $stmt->bindParam(':status', $Provider->status);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("DataBase Error: The Provider could not be updated.<br>{$e->getMessage()}");
            } else {
                $log = new Logger('App');
                $log->pushHandler(new StreamHandler(__DIR__ . './../../logs/errors.log', Logger::ERROR));

                $log->error($e->getMessage(), $e->getTrace());
            }
        } catch (\Throwable $e) {
            if ($_ENV['ENVIRONMENT'] != "production") {
                die("General Error: The Provider could not be updated.<br>{$e->getMessage()}");
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
