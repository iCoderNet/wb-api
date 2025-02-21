<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SalesSeeder extends Seeder
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
            $response = Http::get(env('API_HOST') . '/api/sales', [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'key' => env('API_KEY'),
                'limit' => $limit,
            ]);

            $sales = $response->json()['data'] ?? [];
            $meta = $response->json()['meta'] ?? [];

            if (isset($meta)) {
                echo 'Page: ' . $page . ' Total: ' . $meta['total'] . ' From: ' . $meta['from'] . ' To: ' . $meta['to'] . PHP_EOL;
            }

            foreach ($sales as $sale) {
                Sales::create([
                    'g_number' => $sale['g_number'] ?? null,
                    'date' => $sale['date'] ?? null,
                    'last_change_date' => $sale['last_change_date'] ?? null,
                    'supplier_article' => $sale['supplier_article'] ?? null,
                    'tech_size' => $sale['tech_size'] ?? null,
                    'barcode' => $sale['barcode'] ?? null,
                    'total_price' => $sale['total_price'] ?? null,
                    'discount_percent' => $sale['discount_percent'] ?? null,
                    'is_supply' => $sale['is_supply'] ?? null,
                    'is_realization' => $sale['is_realization'] ?? null,
                    'promo_code_discount' => $sale['promo_code_discount'] ?? null,
                    'warehouse_name' => $sale['warehouse_name'] ?? null,
                    'country_name' => $sale['country_name'] ?? null,
                    'oblast_okrug_name' => $sale['oblast_okrug_name'] ?? null,
                    'region_name' => $sale['region_name'] ?? null,
                    'income_id' => $sale['income_id'] ?? null,
                    'sale_id' => $sale['sale_id'] ?? null,
                    'odid' => $sale['odid'] ?? null,
                    'spp' => $sale['spp'] ?? null,
                    'for_pay' => $sale['for_pay'] ?? null,
                    'finished_price' => $sale['finished_price'] ?? null,
                    'price_with_disc' => $sale['price_with_disc'] ?? null,
                    'nm_id' => $sale['nm_id'] ?? null,
                    'subject' => $sale['subject'] ?? null,
                    'category' => $sale['category'] ?? null,
                    'brand' => $sale['brand'] ?? null,
                    'is_storno' => $sale['is_storno'] ?? null,
                ]);
            }

            $page++;
        } while ($meta['to'] < $meta['total']);
    }
}
