<?php

namespace App\Entities;

/**
 * Customer class
 */
class Customer
{
    public $id;
    public $nationality;
    public $ci;
    public $first_name;
    public $last_name;
    public $birth_date;
    public $address;
    public $phone;
    public $email;
    public $status;

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

            $this->nationality = $data['nationality'];
            $this->ci = $data['ci'];
            $this->first_name = $data['first_name'];
            $this->last_name = $data['last_name'];
            $this->birth_date = $data['birth_date'];
            $this->address = $data['address'];
            $this->phone = $data['phone'];
            $this->email = $data['email'];
            $this->status = $data['status'];
        }
    }
}
