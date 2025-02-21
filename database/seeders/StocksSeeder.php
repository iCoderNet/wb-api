<?php

namespace Database\Seeders;

use App\Models\Stocks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = 1;
        $limit = 500;
        $dateFrom = date('Y-m-d'); // Сегодняшняя дата
        do {
            $response = Http::get(env('API_HOST') . '/api/stocks', [
                'dateFrom' => $dateFrom,
                'page' => $page,
                'key' => env('API_KEY'),
                'limit' => $limit,
            ]);
    
            
            $stocks = $response->json()['data'] ?? [];
            $meta = $response->json()['meta'] ?? [];
            
            if(isset($meta)){
                echo 'Page: ' . $page . ' Total: ' . $meta['total'] . ' From: ' . $meta['from'] . ' To: ' . $meta['to'] . PHP_EOL;
            }
            foreach ($stocks as $stock) {
                Stocks::create([
                    'date' => $stock['date'] ?? null,
                    'last_change_date' => $stock['last_change_date'] ?? null,
                    'supplier_article' => $stock['supplier_article'] ?? null,
                    'tech_size' => $stock['tech_size'] ?? null,
                    'barcode' => $stock['barcode'] ?? null,
                    'quantity' => $stock['quantity'] ?? null,
                    'is_supply' => $stock['is_supply'] ?? null,
                    'is_realization' => $stock['is_realization'] ?? null,
                    'quantity_full' => $stock['quantity_full'] ?? null,
                    'warehouse_name' => $stock['warehouse_name'] ?? null,
                    'in_way_to_client' => $stock['in_way_to_client'] ?? null,
                    'in_way_from_client' => $stock['in_way_from_client'] ?? null,
                    'nm_id' => $stock['nm_id'] ?? null,
                    'subject' => $stock['subject'] ?? null,
                    'category' => $stock['category'] ?? null,
                    'brand' => $stock['brand'] ?? null,
                    'sc_code' => $stock['sc_code'] ?? null,
                    'price' => $stock['price'] ?? null,
                    'discount' => $stock['discount'] ?? null,
                ]);
            }
            
            $page++;
        } while ($meta['to'] < $meta['total']);
    }
}
