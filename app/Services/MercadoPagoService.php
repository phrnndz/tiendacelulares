<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use App\Services\CurrencyConversionService;
use Illuminate\Database\Eloquent\Model;


class MercadoPagoService
{
    use ConsumesExternalServices;
    protected $baseUri;
    protected $key;
    protected $secret;
    protected $baseCurrency;
    protected $converter;
    
    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->key = config('services.mercadopago.key');
        $this->secret = config('services.mercadopago.secret');
        $this->baseCurrency = config('services.mercadopago.base_currency');
        $this->converter = $converter;
    }
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['access_token']= $this->resolveAccessToken();
    }
    public function decodeResponse($response)
    {
        return json_decode($response);
    }
    public function resolveAccessToken()
    {
        return $this->secret;

    }
    public function handlePayment(Request $request)
    {
        $request->validate([
            'card_network' => 'required',
            'card_token' => 'required',
            'email' => 'required',
        ]);

        $payment = $this->createPayment(
            $request->value,
            $request->currency,
            $request->card_network,
            $request->card_token,
            $request->email
        );

        // ATRJETA DE CREDITO DE PRUEBA :4075595716483764
        if ($payment->status === "approved") {
            $infopayment =  [ 
                'result'                => "approved",
                'external_reference'    => $payment->external_reference,
                'name'                  => $payment->payer->first_name,
                'currency'              => strtoupper($payment->currency_id),
                'amount'                => number_format($payment->transaction_amount, 0, ',', '.'),
                'originalAmount'        => $request->value,
                'token'                 => $request->token,
                'originalCurrency'      => strtoupper($request->currency),
                'transaction_amount'    => $request->transaction_amount,
                'token'                 => $request->token,
                'payment_method_id'     => $request->payment_method_id,
                'date_approved'         => $request->date_approved,
                'items'                 => $payment->additional_info->items,
            ];
            return $infopayment;
            // return redirect('checkout')
            //     ->withSuccess(['payment' => "Gracias, {$name}. ¡Listo!, se acreditó tu pago por {$originalAmount}{$originalCurrency}  ( {$amount}{$currency} ). En tu resumen verás el cargo como MERCADOPAGO"]);
        }else {
            $infopayment =[
                'result'                => $payment->status,
                'external_reference'    => $payment->external_reference,
                'name'                  => $payment->payer->first_name,
                'currency'              => strtoupper($payment->currency_id),
                'amount'                => number_format($payment->transaction_amount, 0, ',', '.'),
                'originalAmount'        => $request->value,
                'token'                 => $request->token,
                'originalCurrency'      => strtoupper($request->currency),
                'transaction_amount'    => $request->transaction_amount,
                'token'                 => $request->token,
                'payment_method_id'     => $request->payment_method_id,
                'date_approved'         => $request->date_approved,
                'items'                 => $payment->additional_info->items,
            ];
            return $infopayment;
        }
        // return redirect('checkout')
        //     ->withErrors('No pudimos procesar tu pago. Intentalo de nuevo');


    }

    public function createPayment($value, $currency, $cardNetwork, $cardToken, $email, $installments = 1)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payments',
            [],
            [
                'payer' => [
                    'email' => $email,
                ],
                'binary_mode' => true,
                'transaction_amount' => $value * $this->resolveFactor($currency),
                'payment_method_id' => $cardNetwork,
                'token' => $cardToken,
                'installments' => $installments,
                'statement_descriptor' => "MERCADOPAGO",
                "external_reference"=> "Reference_1234",
                "additional_info"=> [
                    "items"=> [
                        [
                            "id"=> "item-ID-1234",
                            "title"=> "Title of what you are paying for",
                            "picture_url"=> "https=>//www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                            "description"=> "Item description",
                            "category_id"=> "learnings", 
                            "quantity"=> 1,
                            "unit_price"=> 100
                        ]
                    ],
                ]
            ],
            [],
            $isJsonRequest = true
        );
    }

    public function resolveFactor($currency)
    {
        //toda moneda que se reciba se convierte a MXN
        return $this->converter->convertCurrency($currency, $this->baseCurrency);
    }
}