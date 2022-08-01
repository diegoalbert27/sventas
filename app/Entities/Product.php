<?php

namespace App\Entities;

/**
 * Product class
 */
class Product
{
    public $id;
    public $code;
    public $reference;
    public $type_product;
    public $name;
    public $pvp;
    public $badge;
    public $category;
    public $status;
    public $provider;

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

            $this->code = $data['code'];
            $this->reference = $data['reference'];
            $this->type_product = $data['type_product'];
            $this->name = $data['name'];
            $this->pvp = $data['pvp'];
            $this->badge = $data['badge'];
            $this->category = $data['category'];
            $this->status = $data['status'];
            $this->provider = $data['provider'];
        }
    }
}
