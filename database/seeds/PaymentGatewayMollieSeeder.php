<?php

use Illuminate\Database\Seeder;

class PaymentGatewayMollieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_gateways = [
            [
                'id' => 5,
                'name' => 'Mollie',
                'provider_name' => 'Mollie',
                'provider_url' => 'https://www.mollie.com',
                'is_on_site' => 0,
                'can_refund' => 0,
            ],
        ];

        DB::table('payment_gateways')->insert($payment_gateways);
    }
}
