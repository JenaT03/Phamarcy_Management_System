<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use App\Models\ReceiptDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receiptDetails = ReceiptDetail::all();

        foreach ($receiptDetails as $receiptDetail) {
            ProductDetail::create([
                'product_id' => $receiptDetail->product_id,
                'receipt_detail_id' => $receiptDetail->id,
                'quantity' => $receiptDetail->quantity,
                'price' => $receiptDetail->selling_price,
                'expiry' => $receiptDetail->expiry,
            ]);
        }
    }
}
