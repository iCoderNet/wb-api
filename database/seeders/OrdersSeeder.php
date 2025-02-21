<?php

namespace Database\Seeders;

use App\Models\Orders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = 1;
        $limit = 500;
        $dateFrom = date("Y-m-d", strtotime("-3 day")); // 3 дня назад сегодня
        $dateTo = date('Y-m-d'); // Сегодняшняя дата
        do {
            $response = Http::get(env('API_HOST') . '/api/orders', [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'key' => env('API_KEY'),
                'limit' => $limit,
            ]);
    
            $orders = $response->json()['data'] ?? [];
            $meta = $response->json()['meta'] ?? [];
    
            if(isset($meta)){
                echo 'Page: ' . $page . ' Total: ' . $meta['total'] . ' From: ' . $meta['from'] . ' To: ' . $meta['to'] . PHP_EOL;
            }
            foreach ($orders as $order) {
                Orders::create([
                    'g_number' => $order['g_number'] ?? null,
                    'date' => $order['date'] ?? null,
                    'last_change_date' => $order['last_change_date'] ?? null,
                    'supplier_article' => $order['supplier_article'] ?? null,
                    'tech_size' => $order['tech_size'] ?? null,
                    'barcode' => $order['barcode'] ?? null,
                    'total_price' => $order['total_price'] ?? null,
                    'discount_percent' => $order['discount_percent'] ?? null,
                    'warehouse_name' => $order['warehouse_name'] ?? null,
                    'oblast' => $order['oblast'] ?? null,
                    'income_id' => $order['income_id'] ?? null,
                    'odid' => $order['odid'] ?? null,
                    'nm_id' => $order['nm_id'] ?? null,
                    'subject' => $order['subject'] ?? null,
                    'category' => $order['category'] ?? null,
                    'brand' => $order['brand'] ?? null,
                    'is_cancel' => $order['is_cancel'] ?? null,
                    'cancel_dt' => $order['cancel_dt'] ?? null,
                ]);
            }
            $page++;
        } while ($meta['to'] < $meta['total']);
    }
}
