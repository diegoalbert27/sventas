<?php

namespace App\Controllers;

use App\Entities\Customer;
use App\Models\CustomerModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CustomerController class
 */
class CustomerController
{

    /**
     * This method load the 'employees' route. <br/>
     * <b>post: </b>access to GET method.
     */
    public function getIndex()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        return new Response(require '../app/Views/customer.php', 200);
    }

    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $customer_model = new CustomerModel();
        $customers = $customer_model->findAll();

        $body_response = json_encode($customers);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    public function postCustomer(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $new_customer = [
            'nationality'      => $request->request->get('nationality'),
            'ci'               => $request->request->get('ci'),
            'first_name'       => $request->request->get('first_name'),
            'last_name'        => $request->request->get('last_name'),
            'birth_date'       => $request->request->get('birth_date'),
            'address'          => $request->request->get('address'),
            'email'            => $request->request->get('email'),
            'phone'            => $request->request->get('phone'),
            'status'           => 1,
        ];

        $customer = new Customer($new_customer);
        $customer_model = new CustomerModel();
        $is_registered = $customer_model->save($customer);

        $result = null;

        if ($is_registered) {
            $result = [
                'message' => 'success'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_CREATED,
                ['content-type' => 'application/json']
            );
        } else {
            $result = [
                'message' => 'error'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }
    }

    public function editCustomer(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        if (empty($request->request->get('id'))) {
            $result = [
                'message' => 'id is missed'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }


        $request_customer = [
            'nationality'      => $request->request->get('nationality'),
            'ci'               => $request->request->get('ci'),
            'first_name'       => $request->request->get('first_name'),
            'last_name'        => $request->request->get('last_name'),
            'birth_date'       => $request->request->get('birth_date'),
            'address'          => $request->request->get('address'),
            'email'            => $request->request->get('email'),
            'phone'            => $request->request->get('phone'),
            'status'           => $request->request->get('status'),
            'id'               => $request->request->get('id'),
        ];

        $customer_model = new CustomerModel();
        $customer = $customer_model->findById($request_customer['id']);

        if (!$customer) {
            $result = [
                'message' => 'customer not found'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        $edit_customer = [];

        foreach ($request_customer as $key => $value) {
            if (is_null($value)) {
                $edit_customer[$key] = $customer->$key;
            } else {
                $edit_customer[$key] = $value;
            }
        }

        $is_edited = $customer_model->update(new Customer($edit_customer));

        $result = null;

        if ($is_edited) {
            $result = [
                'message' => 'success'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );
        } else {
            $result = [
                'message' => 'error'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }

        return new Response(
            json_encode($edit_customer),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
