<?php

namespace App\Services;

use App\Order;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpResponse;

class PaypalService
{
    private $client;

    function __construct()
    {
        $environment = new SandboxEnvironment('AebJXFPGyHrjxW7g_otiuMiJdtRpepV0j_VvA9HeQmoj6UQjJKns4zjGu2u1tJZxcO7HurrB2jpIgydh','EH-3Mt58e9ybWbWief5mNg1L-3edbnNO_P9CNR6ryyaerRkqj6bfVLSqPpjMxfpcMPecl8HTa50tV3Zb');
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder(int $orderId): HttpResponse
    {

        $request = new OrdersCreateRequest();
        $request->headers["prefer"] = "return=representation";
        // $request->body = $this->checkoutData($orderId);
        $request->body = $this->simpleCheckoutData($orderId);

        return $this->client->execute($request);
    }

    public function captureOrder($paypalOrderId)
    {
        $request = new OrdersCaptureRequest($paypalOrderId);

        return $this->client->execute($request);
    }

    private function simpleCheckoutData($orderId)
    {
        $order = Order::find($orderId);
        return [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => 'e-shop_'. uniqid(),
                "amount" => [
                    "value" => $order->grand_total * $order->item_count,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success', $orderId)
            ]
            ];
    }


    private function checkoutData($orderId)
    {
        $order = Order::find($orderId);
        $orderItems = [];

        foreach($order->items as $item) {

            $orderItems[] = [
                'name' => $item->name,
                'description' => \Str::limit($item->description, 100),
                'quantity' => $item->pivot->quantity,
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => $item->final_price
                ],
                'tax' =>
                [
                    'currency_code' => 'USD',
                    'value' => '0',
                ],
                'category' => 'PHYSICAL_GOODS',

            ];

        }

        $checkoutData = [
            'intent' => 'CAPTURE',
            'application_context' =>
            [
                'return_url' => route('paypal.success', $orderId),
                'cancel_url' => route('paypal.cancel'),
                'brand_name' => 'E-Shop',
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                [
                    'reference_id' =>  uniqid(),
                    'description' => 'Paypal payment',
                    'custom_id' => 'CUST-HighFashions',
                    'soft_descriptor' => 'HighFashions',
                    'items' => $orderItems,
                    'shipping' =>
                    [
                        'method' => 'United States Postal Service',
                        'name' =>
                        [
                            'full_name' => 'Duy Thai',
                        ],
                        'address' =>
                        [
                            'address_line_1' => 'K74/H06/01 Ngo Thi Nham',
                            'address_line_2' => 'K67/3 Yen Bai',
                            'admin_area_2' => 'Da Nang',
                            'admin_area_1' => 'Da Nang',
                            'postal_code' => '55000',
                            'country_code' => 'VN',
                        ],
                    ],
                    'amount' =>
                    [
                        'currency_code' => 'USD',
                        'value' => $order->grand_total * $order->item_count,
                        'breakdown' =>
                        [
                            'item_total' =>
                            [
                                'currency_code' => 'USD',
                                'value' => $order->items->sum('final_price'),
                            ],
                            'shipping' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'handling' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'tax_total' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'shipping_discount' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                        ],
                    ],
                ]
            ],

        ];

        return $checkoutData;
    }
}
