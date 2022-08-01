<?php

namespace App\Entities;

/**
 * Clase de Factura
 */
class Factura
{
    public $id;
    public $factura;
    public $product;
    public $client;
    public $amount;
    public $mount;
    public $date_created;

    /**
     * __construct function
     *
     * @param array|null $data
     */
    public function __construct(?array $data = null)
    {
        if (is_array($data)) {
            if (isset($data['id'])) {
                $this->id = $data['id'];
            }

            $this->factura = $data['factura'];
            $this->product = $data['product'];
            $this->client = $data['client'];
            $this->amount = $data['amount'];
            $this->mount = $data['mount'];
            $this->date_created = $data['date_created'];
        }
    }
}
