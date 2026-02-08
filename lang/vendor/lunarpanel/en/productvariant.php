<?php
return [
    'label' => 'Varian Produk',
    'plural_label' => 'Varian Produk',
    'pages' => [
        'edit' => [
            'title' => 'Informasi Dasar',
        ],
        'media' => [
            'title' => 'Media',
            'form' => [
                'no_selection' => [
                    'label' => 'Anda saat ini belum memilih gambar untuk varian ini.',
                ],
                'no_media_available' => [
                    'label' => 'Saat ini tidak ada media yang tersedia pada produk ini.',
                ],
                'images' => [
                    'label' => 'Gambar Utama',
                    'helper_text' => 'Pilih gambar produk yang mewakili varian ini.',
                ],
            ],
        ],
        'identifiers' => [
            'title' => 'Identifikasi',
        ],
        'inventory' => [
            'title' => 'Inventaris',
        ],
        'shipping' => [
            'title' => 'Pengiriman',
        ],
    ],
    'form' => [
        'sku' => [
            'label' => 'SKU',
        ],
        'gtin' => [
            'label' => 'Global Trade Item Number (GTIN)',
        ],
        'mpn' => [
            'label' => 'Manufacturer Part Number (MPN)',
        ],
        'ean' => [
            'label' => 'UPC/EAN',
        ],
        'stock' => [
            'label' => 'Stok Tersedia',
        ],
        'backorder' => [
            'label' => 'Dalam Pesanan Tertunda',
        ],
        'purchasable' => [
            'label' => 'Dapat Dibeli',
            'options' => [
                'always' => 'Selalu',
                'in_stock' => 'Stok Tersedia',
                'in_stock_or_on_backorder' => 'Stok Tersedia atau Pesanan Tertunda',
            ],
        ],
        'unit_quantity' => [
            'label' => 'Jumlah Unit',
            'helper_text' => 'Berapa banyak item individual yang membentuk 1 unit.',
        ],
        'min_quantity' => [
            'label' => 'Jumlah Minimum',
            'helper_text' => 'Jumlah minimum varian produk yang dapat dibeli dalam satu pembelian.',
        ],
        'quantity_increment' => [
            'label' => 'Kelipatan Jumlah',
            'helper_text' => 'Varian produk harus dibeli dalam kelipatan jumlah ini.',
        ],
        'tax_class_id' => [
            'label' => 'Kelas Pajak',
        ],
        'shippable' => [
            'label' => 'Dapat Dikirim',
        ],
        'length_value' => [
            'label' => 'Panjang',
        ],
        'length_unit' => [
            'label' => 'Satuan Panjang',
        ],
        'width_value' => [
            'label' => 'Lebar',
        ],
        'width_unit' => [
            'label' => 'Satuan Lebar',
        ],
        'height_value' => [
            'label' => 'Tinggi',
        ],
        'height_unit' => [
            'label' => 'Satuan Tinggi',
        ],
        'weight_value' => [
            'label' => 'Berat',
        ],
        'weight_unit' => [
            'label' => 'Satuan Berat',
        ],
    ],
];
