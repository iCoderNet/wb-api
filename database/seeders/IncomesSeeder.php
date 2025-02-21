<?php

namespace Database\Seeders;

use App\Models\Incomes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class IncomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = 1;
        $limit = 500;
        $dateFrom = date("Y-m-d", strtotime("-10 day")); // 10 дня назад сегодня
        $dateTo = date('Y-m-d'); // Сегодняшняя дата

        do {
            $response = Http::get(env('API_HOST') . '/api/incomes', [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'key' => env('API_KEY'),
                'limit' => $limit,
            ]);

            $incomes = $response->json()['data'] ?? [];
            $meta = $response->json()['meta'] ?? [];

            if (isset($meta)) {
                echo 'Page: ' . $page . ' Total: ' . $meta['total'] . ' From: ' . $meta['from'] . ' To: ' . $meta['to'] . PHP_EOL;
            }

            foreach ($incomes as $income) {
                Incomes::create([
                    'income_id' => $income['income_id'] ?? null,
                    'number' => $income['number'] ?? null,
                    'date' => $income['date'] ?? null,
                    'last_change_date' => $income['last_change_date'] ?? null,
                    'supplier_article' => $income['supplier_article'] ?? null,
                    'tech_size' => $income['tech_size'] ?? null,
                    'barcode' => $income['barcode'] ?? null,
                    'quantity' => $income['quantity'] ?? null,
                    'total_price' => $income['total_price'] ?? null,
                    'date_close' => $income['date_close'] ?? null,
                    'warehouse_name' => $income['warehouse_name'] ?? null,
                    'nm_id' => $income['nm_id'] ?? null,
                ]);
            }

            $page++;
        } while ($meta['to'] < $meta['total']);
    }
}
