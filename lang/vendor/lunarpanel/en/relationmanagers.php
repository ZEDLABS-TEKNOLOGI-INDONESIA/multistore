<?php

return [
    'customer_groups' => [
        'title' => 'Grup Pelanggan',
        'actions' => [
            'attach' => [
                'label' => 'Lampirkan Grup Pelanggan',
            ],
        ],
        'form' => [
            'name' => [
                'label' => 'Nama',
            ],
            'enabled' => [
                'label' => 'Diaktifkan',
            ],
            'starts_at' => [
                'label' => 'Tanggal Mulai',
            ],
            'ends_at' => [
                'label' => 'Tanggal Berakhir',
            ],
            'visible' => [
                'label' => 'Terlihat',
            ],
            'purchasable' => [
                'label' => 'Dapat Dibeli',
            ],
        ],
        'table' => [
            'description' => 'Kaitkan grup pelanggan ke :type ini untuk menentukan ketersediaannya.',
            'name' => [
                'label' => 'Nama',
            ],
            'enabled' => [
                'label' => 'Diaktifkan',
            ],
            'starts_at' => [
                'label' => 'Tanggal Mulai',
            ],
            'ends_at' => [
                'label' => 'Tanggal Berakhir',
            ],
            'visible' => [
                'label' => 'Terlihat',
            ],
            'purchasable' => [
                'label' => 'Dapat Dibeli',
            ],
        ],
    ],
    'channels' => [
        'title' => 'Channel',
        'actions' => [
            'attach' => [
                'label' => 'Jadwalkan Channel Lain',
            ],
        ],
        'form' => [
            'enabled' => [
                'label' => 'Diaktifkan',
                'helper_text_false' => 'Channel ini tidak akan diaktifkan meskipun ada tanggal mulai.',
            ],
            'starts_at' => [
                'label' => 'Tanggal Mulai',
                'helper_text' => 'Kosongkan untuk tersedia dari tanggal kapan saja.',
            ],
            'ends_at' => [
                'label' => 'Tanggal Berakhir',
                'helper_text' => 'Kosongkan untuk tersedia tanpa batas waktu.',
            ],
        ],
        'table' => [
            'description' => 'Tentukan channel mana yang diaktifkan dan jadwalkan ketersediaannya.',
            'name' => [
                'label' => 'Nama',
            ],
            'enabled' => [
                'label' => 'Diaktifkan',
            ],
            'starts_at' => [
                'label' => 'Tanggal Mulai',
            ],
            'ends_at' => [
                'label' => 'Tanggal Berakhir',
            ],
        ],
    ],
    'medias' => [
        'title' => 'Media',
        'title_plural' => 'Media',
        'actions' => [
            'attach' => [
                'label' => 'Lampirkan Media',
            ],
            'create' => [
                'label' => 'Buat Media',
            ],
            'detach' => [
                'label' => 'Lepaskan',
            ],
            'view' => [
                'label' => 'Lihat',
            ],
        ],
        'form' => [
            'name' => [
                'label' => 'Nama',
            ],
            'media' => [
                'label' => 'Gambar',
            ],
            'primary' => [
                'label' => 'Utama',
            ],
        ],
        'table' => [
            'image' => [
                'label' => 'Gambar',
            ],
            'file' => [
                'label' => 'File',
            ],
            'name' => [
                'label' => 'Nama',
            ],
            'primary' => [
                'label' => 'Utama',
            ],
        ],
        'all_media_attached' => 'Tidak ada gambar produk yang tersedia untuk dilampirkan',
        'variant_description' => 'Lampirkan gambar produk ke varian ini',
    ],
    'urls' => [
        'title' => 'URL',
        'title_plural' => 'URL',
        'actions' => [
            'create' => [
                'label' => 'Buat URL',
            ],
        ],
        'filters' => [
            'language_id' => [
                'label' => 'Bahasa',
            ],
        ],
        'form' => [
            'slug' => [
                'label' => 'Slug',
            ],
            'default' => [
                'label' => 'Default',
            ],
            'language' => [
                'label' => 'Bahasa',
            ],
        ],
        'table' => [
            'slug' => [
                'label' => 'Slug',
            ],
            'default' => [
                'label' => 'Default',
            ],
            'language' => [
                'label' => 'Bahasa',
            ],
        ],
    ],
    'customer_group_pricing' => [
        'title' => 'Harga Grup Pelanggan',
        'title_plural' => 'Harga Grup Pelanggan',
        'table' => [
            'heading' => 'Harga Grup Pelanggan',
            'description' => 'Kaitkan harga ke grup pelanggan untuk menentukan harga produk.',
            'empty_state' => [
                'label' => 'Tidak ada harga grup pelanggan.',
                'description' => 'Buat harga grup pelanggan untuk memulai.',
            ],
            'actions' => [
                'create' => [
                    'label' => 'Tambah Harga Grup Pelanggan',
                    'modal' => [
                        'heading' => 'Buat Harga Grup Pelanggan',
                    ],
                ],
            ],
        ],
    ],
    'pricing' => [
        'title' => 'Harga',
        'title_plural' => 'Harga',
        'tab_name' => 'Harga Bertingkat',
        'table' => [
            'heading' => 'Harga Bertingkat',
            'description' => 'Kurangi harga ketika pelanggan membeli dalam jumlah yang lebih besar.',
            'empty_state' => [
                'label' => 'Tidak ada harga bertingkat.',
            ],
            'actions' => [
                'create' => [
                    'label' => 'Tambah Harga Bertingkat',
                ],
            ],
            'price' => [
                'label' => 'Harga',
            ],
            'customer_group' => [
                'label' => 'Grup Pelanggan',
                'placeholder' => 'Semua Grup Pelanggan',
            ],
            'min_quantity' => [
                'label' => 'Jumlah Minimum',
            ],
            'currency' => [
                'label' => 'Mata Uang',
            ],
        ],
        'form' => [
            'price' => [
                'label' => 'Harga',
                'helper_text' => 'Harga pembelian, sebelum diskon.',
            ],
            'customer_group_id' => [
                'label' => 'Grup Pelanggan',
                'placeholder' => 'Semua Grup Pelanggan',
                'helper_text' => 'Pilih grup pelanggan untuk menerapkan harga ini.',
            ],
            'min_quantity' => [
                'label' => 'Jumlah Minimum',
                'helper_text' => 'Pilih jumlah minimum agar harga ini tersedia.',
                'validation' => [
                    'unique' => 'Grup Pelanggan dan Jumlah Minimum harus unik.',
                ],
            ],
            'currency_id' => [
                'label' => 'Mata Uang',
                'helper_text' => 'Pilih mata uang untuk harga ini.',
            ],
            'compare_price' => [
                'label' => 'Harga Pembanding',
                'helper_text' => 'Harga asli atau RRP, untuk perbandingan dengan harga pembelian.',
            ],
            'basePrices' => [
                'title' => 'Harga',
                'form' => [
                    'price' => [
                        'label' => 'Harga',
                        'helper_text' => 'Harga pembelian, sebelum diskon.',
                        'sync_price' => 'Harga disinkronkan dengan mata uang default.',
                    ],
                    'compare_price' => [
                        'label' => 'Harga Pembanding',
                        'helper_text' => 'Harga asli atau RRP, untuk perbandingan dengan harga pembelian.',
                    ],
                ],
                'tooltip' => 'Dibuat secara otomatis berdasarkan nilai tukar mata uang.',
            ],
        ],
    ],
    'tax_rate_amounts' => [
        'table' => [
            'description' => '',
            'percentage' => [
                'label' => 'Persentase',
            ],
            'tax_class' => [
                'label' => 'Kelas Pajak',
            ],
        ],
    ],
    'values' => [
        'title' => 'Nilai',
        'form' => [
            'name' => [
                'label' => 'Nama',
            ],
        ],
        'table' => [
            'name' => [
                'label' => 'Nama',
            ],
            'position' => [
                'label' => 'Posisi',
            ],
        ],
    ],

];
