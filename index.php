<?php
require 'vendor/autoload.php';
if (1){
$stripe = new \Stripe\StripeClient('sk_test_51OFWvTLb2fG7dWSAVKtkUIw6CcEsctUy9g3AJzMkleJJDqIH4tqGu2xtDp5QnS10eHHl0mAgG0Dar87Qdmk7jhxF00gV2THkjt');


$customer = $stripe->customers->create(
    [
        'name' => "Vet_Services",
        'address' => [
            'line1' =>'Demo address',
            'postal_code' => '738933',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'US',

]
    ]
);
$ephemeralKey = $stripe->ephemeralKeys->create([
    'customer' => $customer->id,
], [
    'stripe_version' => '2022-08-01',
]);
$paymentIntent = $stripe->paymentIntents->create([
    'amount' => 333,
    'currency' => 'usd',
    'description' => 'Payment for Booking Services',
    'customer' => $customer->id,
    'automatic_payment_methods' => [
        'enabled' => 'true',
    ],
]);

echo json_encode(
    [
        'paymentIntent' => $paymentIntent->client_secret,
        'ephemeralKey' => $ephemeralKey->secret,
        'customer' => $customer->id,
        'publishableKey' => 'pk_test_51OFWvTLb2fG7dWSAV6AF4EgJwNtn7LKaayKPXXGL4waVQRum5PCdxiQoZtjuKBKxQMKmxZ7Gky7wp8mPPCLxsxuy00EDcy2wnL'
    ]
);
http_response_code(200);
} echo "Not authorised";
