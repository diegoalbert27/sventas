<?php

namespace App\Controllers;

use App\Entities\Customer;
use App\Models\CustomerModel;
use App\Tasks\TaskCustomer;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    public function sync()
    {
        $task_customer = new TaskCustomer();
        $customers = $task_customer->findAll();

        $customer_model = new CustomerModel();

        foreach ($customers as $customer) {
            if (!$customer_model->findName('ci', $customer['ci'])) {
                $customer_model->save(new Customer($customer));
            }
        }
        
        return new Response(json_encode($customers), 200);
    }
}
