<?php

namespace App\Controllers;

use App\Entities\Provider;
use App\Models\ProviderModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProviderController class
 */
class ProviderController
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

        return new Response(require '../app/Views/provider.php', 200);
    }

    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $provider_model = new ProviderModel();
        $providers = $provider_model->findAll();

        $body_response = json_encode($providers);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    public function postProvider(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $reference = strtoupper(substr($request->request->get('company'), 0, 4));

        $new_provider = [
            'reference'        => $reference,
            'origin'           => $request->request->get('origin'),
            'rif'              => $request->request->get('rif'),
            'name'             => $request->request->get('name'),
            'company'          => $request->request->get('company'),
            'address'          => $request->request->get('address'),
            'email'            => $request->request->get('email'),
            'phone'            => $request->request->get('phone'),
            'status'           => 1
        ];

        $provider = new Provider($new_provider);
        $provider_model = new ProviderModel();
        $is_registered = $provider_model->save($provider);

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

    public function editProvider(Request $request)
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


        $request_provider = [
            'reference'        => $request->request->get('reference'),
            'origin'           => $request->request->get('origin'),
            'rif'              => $request->request->get('rif'),
            'name'             => $request->request->get('name'),
            'company'          => $request->request->get('company'),
            'address'          => $request->request->get('address'),
            'email'            => $request->request->get('email'),
            'phone'            => $request->request->get('phone'),
            'status'           => $request->request->get('status'),
            'id'               => $request->request->get('id')
        ];

        $provider_model = new ProviderModel();
        $provider = $provider_model->findById($request_provider['id']);

        if (!$provider) {
            $result = [
                'message' => 'Provider not found'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        $edit_provider = [];

        foreach ($request_provider as $key => $value) {
            if (is_null($value)) {
                $edit_provider[$key] = $provider->$key;
            } else {
                $edit_provider[$key] = $value;
            }
        }

        $is_edited = $provider_model->update(new Provider($edit_provider));

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
            json_encode($edit_provider),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
