<?php

namespace App\Entities;

/**
 * Provider class
 */
class Provider
{
    public $id;
    public $reference;
    public $name;
    public $company;
    public $address;
    public $phone;
    public $rif;
    public $email;
    public $origin;
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

            $this->reference = $data['reference'];
            $this->rif = $data['rif'];
            $this->name = $data['name'];
            $this->company = $data['company'];
            $this->origin = $data['origin'];
            $this->address = $data['address'];
            $this->phone = $data['phone'];
            $this->email = $data['email'];
            $this->status = $data['status'];
        }
    }
}
