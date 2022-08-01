<?php

namespace App\Entities;

/**
 * Category class
 */
class Category
{

    public $id;
    public $name;
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

            $this->name = $data['name'];
            $this->status = $data['status'];
        }
    }
}
