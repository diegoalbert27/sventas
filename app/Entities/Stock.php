<?php

namespace App\Entities;

/**
 * Stock class
 */
class Stock
{

    public $id;
    public $product;
    public $stock;

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

            $this->product = $data['product'];
            $this->stock = $data['stock'];
        }
    }
}
