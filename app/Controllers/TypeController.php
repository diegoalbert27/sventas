<?php

namespace App\Controllers;

use App\Models\TypeModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * TypeController class
 */
class TypeController
{
    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $type_model = new TypeModel();
        $types = $type_model->findAll();

        $body_response = json_encode($types);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
