<?php

namespace App\Controllers;

use App\Entities\Product;
use App\Entities\Stock;

use App\Models\ProductModel;
use App\Models\StockModel;
use App\Models\CategoryModel;
use App\Models\TypeModel;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductController class
 */
class ProductController
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

        return new Response(require '../app/Views/product.php', 200);
    }

    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $Product_model = new ProductModel();
        $products = $Product_model->findAll();

        $category_model = new CategoryModel();
        $type_model = new TypeModel();
        $stock_model = new StockModel();

        foreach($products as $product) {
            $product->category = $category_model->findById($product->category);
            $product->type_product = $type_model->findById((int)$product->type_product);
            $product->stock = $stock_model->findByProduct((int)$product->id);
        }

        $body_response = json_encode($products);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    public function postProduct(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $new_Product = [
            'code'              => $request->request->get('code'),
            'reference'         => $request->request->get('reference'),
            'type_product'      => $request->request->get('type_product'),
            'name'              => $request->request->get('name'),
            'pvp'               => $request->request->get('pvp'),
            'badge'             => $request->request->get('badge'),
            'category'          => $request->request->get('category'),
            'status'            => 1,
            'provider'          => $request->request->get('provider')
        ];

        $product = new Product($new_Product);
        $product_model = new ProductModel();
        $is_registered = $product_model->save($product);

        $result = null;

        if ($is_registered) {
            $result = [
                'message' => 'success'
            ];

            $product_id = $product_model->last_insert_id;

            $new_stock = [
                'product' => $product_id,
                'stock' => $request->request->get('stock')
            ];

            $stock_model = new StockModel();

            $is_registered = $stock_model->save(new Stock($new_stock));

            if ($is_registered) {
                $body_response = json_encode($result);

                return new Response(
                    $body_response,
                    Response::HTTP_CREATED,
                    ['content-type' => 'application/json']
                );
            }
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

    public function editProduct(Request $request)
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


        $request_product = [
            'code'              => $request->request->get('code'),
            'reference'         => $request->request->get('reference'),
            'type_product'      => $request->request->get('type_product'),
            'name'              => $request->request->get('name'),
            'pvp'               => $request->request->get('pvp'),
            'badge'             => $request->request->get('badge'),
            'category'          => $request->request->get('category'),
            'status'            => $request->request->get('status'),
            'provider'          => $request->request->get('provider'),
            'id'                => $request->request->get('id')
        ];

        $product_model = new ProductModel();
        $product = $product_model->findById($request_product['id']);

        if (!$product) {
            $result = [
                'message' => 'Product not found'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        $edit_product = [];

        foreach ($request_product as $key => $value) {
            if (is_null($value)) {
                $edit_product[$key] = $product->$key;
            } else {
                $edit_product[$key] = $value;
            }
        }

        $is_edited = $product_model->update(new Product($edit_product));

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
            json_encode($edit_product),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
