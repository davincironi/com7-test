<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchsaeOrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateNewPurchaseOrder(): void
    {
        $response = $this->json('POST', route('auth.login'), [
            'email' => 'admin@com7.com',
            'password' => 'admin'
        ]);
        $token = $response->original['token'];

        $body = [
            "phone" => "0863744338",
            "bill_address" => "Nonthaburi, 11120",
            "ship_address" => "Nonthaburi, 11120",
            "summary_price" => 4221,
            "items" => [
                0 => [
                    "product_id" => 1,
                    "product_name" => "Axel Krajcik",
                    "quantity" => 1,
                    "price" => 4221,
                    "total_price" => 4221
                ]
            ]
        ];
        $header = [
            "Authorization" => "Bearer " . $token
        ];
        $response = $this->post('/api/public/purchase-order', $body, $header);
        $response->assertStatus(201);
    }
}
