<?php

namespace App\Controllers;

use App\Entities\Factura;
use App\Entities\Stock;
use App\Models\FacturaModel;
use App\Models\StockModel;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SalesController class
 */
class SalesController
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

        return new Response(require '../app/Views/sales.php', 200);
    }

    public function getSale()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        return new Response(require '../app/Views/sale.php', 200);
    }

    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $factura_model = new FacturaModel();
        $facturas = $factura_model->findAll();

        $body_response = json_encode($facturas);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    public function postSale(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $stock_model = new StockModel();

        $stock = $stock_model->findByProduct($request->request->get('product'));

        if (!$stock) {
            $result = [
                'message' => 'product not found'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        if ($stock->stock <= 0 || $stock->stock < $request->request->get('amount')) {
            $result = [
                'message' => 'error stock product'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        $stock->stock = $stock->stock - $request->request->get('amount');
        $stock_model->update($stock);

        $factura = uniqid();

        $date_created = date('Y-m-d');

        $new_sele = [
            'factura'          => $factura,
            'product'          => $request->request->get('product'),
            'client'           => $request->request->get('client'),
            'amount'           => $request->request->get('amount'),
            'mount'            => $request->request->get('mount'),
            'date_created'     => $date_created
        ];

        $sale = new Factura($new_sele);
        $factura_model = new FacturaModel();
        $is_registered = $factura_model->save($sale);

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
}
