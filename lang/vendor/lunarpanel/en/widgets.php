<?php

return [
    'dashboard' => [
        'orders' => [
            'order_stats_overview' => [
                'stat_one' => [
                    'label' => 'Pesanan hari ini',
                    'increase' => 'Naik :percentage% dari :count kemarin',
                    'decrease' => 'Turun :percentage% dari :count kemarin',
                    'neutral' => 'Tidak ada perubahan dibandingkan kemarin',
                ],
                'stat_two' => [
                    'label' => 'Pesanan 7 hari terakhir',
                    'increase' => 'Naik :percentage% dari :count periode sebelumnya',
                    'decrease' => 'Turun :percentage% dari :count periode sebelumnya',
                    'neutral' => 'Tidak ada perubahan dibandingkan periode sebelumnya',
                ],
                'stat_three' => [
                    'label' => 'Pesanan 30 hari terakhir',
                    'increase' => 'Naik :percentage% dari :count periode sebelumnya',
                    'decrease' => 'Turun :percentage% dari :count periode sebelumnya',
                    'neutral' => 'Tidak ada perubahan dibandingkan periode sebelumnya',
                ],
                'stat_four' => [
                    'label' => 'Penjualan hari ini',
                    'increase' => 'Naik :percentage% dari :total kemarin',
                    'decrease' => 'Turun :percentage% dari :total kemarin',
                    'neutral' => 'Tidak ada perubahan dibandingkan kemarin',
                ],
                'stat_five' => [
                    'label' => 'Penjualan 7 hari terakhir',
                    'increase' => 'Naik :percentage% dari :total periode sebelumnya',
                    'decrease' => 'Turun :percentage% dari :total periode sebelumnya',
                    'neutral' => 'Tidak ada perubahan dibandingkan periode sebelumnya',
                ],
                'stat_six' => [
                    'label' => 'Penjualan 30 hari terakhir',
                    'increase' => 'Naik :percentage% dari :total periode sebelumnya',
                    'decrease' => 'Turun :percentage% dari :total periode sebelumnya',
                    'neutral' => 'Tidak ada perubahan dibandingkan periode sebelumnya',
                ],
            ],
            'order_totals_chart' => [
                'heading' => 'Total pesanan untuk tahun lalu',
                'series_one' => [
                    'label' => 'Periode Ini',
                ],
                'series_two' => [
                    'label' => 'Periode Sebelumnya',
                ],
                'yaxis' => [
                    'label' => 'Omset :currency',
                ],
            ],
            'order_sales_chart' => [
                'heading' => 'Laporan Pesanan / Penjualan',
                'series_one' => [
                    'label' => 'Pesanan',
                ],
                'series_two' => [
                    'label' => 'Pendapatan',
                ],
                'yaxis' => [
                    'series_one' => [
                        'label' => 'Jumlah Pesanan',
                    ],
                    'series_two' => [
                        'label' => 'Total Nilai',
                    ],
                ],
            ],
            'average_order_value' => [
                'heading' => 'Nilai Rata-rata Pesanan',
            ],
            'new_returning_customers' => [
                'heading' => 'Pelanggan Baru vs Pelanggan Kembali',
                'series_one' => [
                    'label' => 'Pelanggan Baru',
                ],
                'series_two' => [
                    'label' => 'Pelanggan Kembali',
                ],
            ],
            'popular_products' => [
                'heading' => 'Produk terlaris (12 bulan terakhir)',
                'description' => 'Angka-angka ini berdasarkan jumlah kemunculan produk pada pesanan, bukan jumlah yang dipesan.',
            ],
            'latest_orders' => [
                'heading' => 'Pesanan terbaru',
            ],
        ],
    ],
    'customer' => [
        'stats_overview' => [
            'total_orders' => [
                'label' => 'Total pesanan',
            ],
            'avg_spend' => [
                'label' => 'Rata-rata Pembelanjaan',
            ],
            'total_spend' => [
                'label' => 'Total Pembelanjaan',
            ],
        ],
    ],
    'variant_switcher' => [
        'label' => 'Ganti Varian',
        'table' => [
            'sku' => [
                'label' => 'SKU',
            ],
            'values' => [
                'label' => 'Nilai',
            ],
        ],
    ],
];
