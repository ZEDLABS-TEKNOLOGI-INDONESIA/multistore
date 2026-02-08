<?php
return [
    'label' => 'Produk',
    'plural_label' => 'Produk',
    'tabs' => [
        'all' => 'Semua',
        'published' => 'Dipublikasikan',
        'draft' => 'Draf',
    ],
    'status' => [
        'unpublished' => [
            'content' => 'Saat ini dalam status draf, produk ini disembunyikan di semua channel dan grup pelanggan.',
        ],
        'availability' => [
            'customer_groups' => 'Produk ini saat ini tidak tersedia untuk semua grup pelanggan.',
            'channels' => 'Produk ini saat ini tidak tersedia untuk semua channel.',
        ],
    ],
    'table' => [
        'status' => [
            'label' => 'Status',
            'states' => [
                'deleted' => 'Dihapus',
                'draft' => 'Draf',
                'published' => 'Dipublikasikan',
            ],
        ],
        'name' => [
            'label' => 'Nama',
        ],
        'brand' => [
            'label' => 'Merek',
        ],
        'sku' => [
            'label' => 'SKU',
        ],
        'stock' => [
            'label' => 'Stok',
        ],
        'producttype' => [
            'label' => 'Tipe Produk',
        ],
    ],
    'actions' => [
        'edit_status' => [
            'label' => 'Perbarui Status',
            'heading' => 'Perbarui Status',
        ],
    ],
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
        'brand' => [
            'label' => 'Merek',
        ],
        'sku' => [
            'label' => 'SKU',
        ],
        'producttype' => [
            'label' => 'Tipe Produk',
        ],
        'status' => [
            'label' => 'Status',
            'options' => [
                'published' => [
                    'label' => 'Dipublikasikan',
                    'description' => 'Produk ini akan tersedia di semua grup pelanggan dan channel yang diaktifkan',
                ],
                'draft' => [
                    'label' => 'Draf',
                    'description' => 'Produk ini akan disembunyikan di semua channel dan grup pelanggan',
                ],
            ],
        ],
        'tags' => [
            'label' => 'Tag',
            'helper_text' => 'Pisahkan tag dengan menekan Enter, Tab atau koma (,)',
        ],
        'collections' => [
            'label' => 'Koleksi',
            'select_collection' => 'Pilih koleksi',
        ],
    ],
    'pages' => [
        'availability' => [
            'label' => 'Ketersediaan',
        ],
        'edit' => [
            'title' => 'Informasi Dasar',
        ],
        'identifiers' => [
            'label' => 'Identifikasi Produk',
        ],
        'inventory' => [
            'label' => 'Inventaris',
        ],
        'pricing' => [
            'form' => [
                'tax_class_id' => [
                    'label' => 'Kelas Pajak',
                ],
                'tax_ref' => [
                    'label' => 'Referensi Pajak',
                    'helper_text' => 'Opsional, untuk integrasi dengan sistem pihak ketiga.',
                ],
            ],
        ],
        'shipping' => [
            'label' => 'Pengiriman',
        ],
        'variants' => [
            'label' => 'Varian',
        ],
        'collections' => [
            'label' => 'Koleksi',
            'select_collection' => 'Pilih koleksi',
        ],
        'associations' => [
            'label' => 'Asosiasi Produk',
        ],
    ],
];
