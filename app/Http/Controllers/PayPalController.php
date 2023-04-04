<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'codesolutionstuff.com',
                'price' => 10,
                'desc' => 'Description for codesolutionstuff.com',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 10;

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function cancel()
    {
        return route('client.dathang.error');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function success(Request $request)
    {
        /*
        PAYERID,FIRSTNAME,LASTNAME,EMAIL,L_QTY0,L_TAXAMT0,L_AMT0,L_DESC0,
        */
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        DB::insert(
            'insert into paypal_checkout (PAYERID,FIRSTNAME,LASTNAME,EMAIL,L_QTY0,L_TAXAMT0,L_AMT0,L_DESC0) values (?, ?, ?, ?, ?, ?, ?, ?)',
            [$response['PAYERID'], $response['FIRSTNAME'], $response['LASTNAME'], $response['EMAIL'], $response['L_QTY0'], $response['L_TAXAMT0'], $response['L_AMT0'], $response['L_DESC0']]
        );
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect()->route('client.dathang.success');
        }

        dd('Something is wrong.');
    }
}
