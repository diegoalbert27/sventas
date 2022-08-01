<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * CategoryController class
 */
class CategoryController
{
    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $category_model = new CategoryModel();
        $categories = $category_model->findAll();

        $body_response = json_encode($categories);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
