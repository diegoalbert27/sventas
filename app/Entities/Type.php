<?php

namespace App\Entities;

/**
 * Type class
 */
class Type
{

    public $id;
    public $code;
    public $name;

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
            $this->name = $data['name'];
        }
    }
}
