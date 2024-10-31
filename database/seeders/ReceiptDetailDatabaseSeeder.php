<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptDetailDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receipt = Receipt::first();


        if ($receipt) {
            $products = Product::all();

            foreach ($products as $product) {
                ReceiptDetail::create([
                    'receipt_id' => $receipt->id,
                    'product_id' => $product->id,
                    'product_code' => $product->code,
                    'quantity' => 5,
                    'original_price' => 100000,
                    'selling_price' => 170000,
                    'expiry' => Carbon::now()->addMonths(10),
                ]);
            }
        }
    }
}
