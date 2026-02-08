<?php

return [
    'plural_label' => 'Diskon',
    'label' => 'Diskon',
    'form' => [
        'conditions' => [
            'heading' => 'Kondisi',
        ],
        'buy_x_get_y' => [
            'heading' => 'Beli X Dapat Y',
        ],
        'amount_off' => [
            'heading' => 'Potongan Harga',
        ],
        'name' => [
            'label' => 'Nama',
        ],
        'handle' => [
            'label' => 'Handle',
        ],
        'starts_at' => [
            'label' => 'Tanggal Mulai',
        ],
        'ends_at' => [
            'label' => 'Tanggal Berakhir',
        ],
        'priority' => [
            'label' => 'Prioritas',
            'helper_text' => 'Diskon dengan prioritas lebih tinggi akan diterapkan terlebih dahulu.',
            'options' => [
                'low' => [
                    'label' => 'Rendah',
                ],
                'medium' => [
                    'label' => 'Sedang',
                ],
                'high' => [
                    'label' => 'Tinggi',
                ],
            ],
        ],
        'stop' => [
            'label' => 'Hentikan diskon lain diterapkan setelah diskon ini',
        ],
        'coupon' => [
            'label' => 'Kupon',
            'helper_text' => 'Masukkan kupon yang diperlukan agar diskon diterapkan, jika dibiarkan kosong akan diterapkan secara otomatis.',
        ],
        'max_uses' => [
            'label' => 'Penggunaan maksimal',
            'helper_text' => 'Kosongkan untuk penggunaan tanpa batas.',
        ],
        'max_uses_per_user' => [
            'label' => 'Penggunaan maksimal per pengguna',
            'helper_text' => 'Kosongkan untuk penggunaan tanpa batas.',
        ],
        'minimum_cart_amount' => [
            'label' => 'Jumlah Keranjang Minimum',
        ],
        'min_qty' => [
            'label' => 'Jumlah Produk',
            'helper_text' => 'Tetapkan berapa banyak produk yang memenuhi syarat diperlukan agar diskon diterapkan.',
        ],
        'reward_qty' => [
            'label' => 'Jumlah item gratis',
            'helper_text' => 'Berapa banyak dari setiap item yang didiskon.',
        ],
        'max_reward_qty' => [
            'label' => 'Jumlah hadiah maksimal',
            'helper_text' => 'Jumlah maksimum produk yang dapat didiskon, terlepas dari kriteria.',
        ],
        'automatic_rewards' => [
            'label' => 'Otomatis tambahkan hadiah',
            'helper_text' => 'Aktifkan untuk menambahkan produk hadiah ketika tidak ada di keranjang.',
        ],
        'fixed_value' => [
            'label' => 'Nilai tetap',
        ],
        'percentage' => [
            'label' => 'Persentase',
        ],
    ],
    'table' => [
        'name' => [
            'label' => 'Nama',
        ],
        'status' => [
            'label' => 'Status',
            \Lunar\Models\Discount::ACTIVE => [
                'label' => 'Aktif',
            ],
            \Lunar\Models\Discount::PENDING => [
                'label' => 'Tertunda',
            ],
            \Lunar\Models\Discount::EXPIRED => [
                'label' => 'Kedaluwarsa',
            ],
            \Lunar\Models\Discount::SCHEDULED => [
                'label' => 'Terjadwal',
            ],
        ],
        'type' => [
            'label' => 'Tipe',
        ],
        'starts_at' => [
            'label' => 'Tanggal Mulai',
        ],
        'ends_at' => [
            'label' => 'Tanggal Berakhir',
        ],
        'created_at' => [
            'label' => 'Dibuat Pada',
        ],
        'coupon' => [
            'label' => 'Kupon',
        ],
    ],
    'pages' => [
        'availability' => [
            'label' => 'Ketersediaan',
        ],
        'edit' => [
            'title' => 'Informasi Dasar',
        ],
        'limitations' => [
            'label' => 'Pembatasan',
        ],
    ],
    'relationmanagers' => [
        'collections' => [
            'title' => 'Koleksi',
            'description' => 'Pilih koleksi mana yang harus dibatasi untuk diskon ini.',
            'actions' => [
                'attach' => [
                    'label' => 'Lampirkan Koleksi',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'type' => [
                    'label' => 'Tipe',
                    'limitation' => [
                        'label' => 'Pembatasan',
                    ],
                    'exclusion' => [
                        'label' => 'Pengecualian',
                    ],
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
        'customers' => [
            'title' => 'Pelanggan',
            'description' => 'Pilih pelanggan mana yang harus dibatasi untuk diskon ini.',
            'actions' => [
                'attach' => [
                    'label' => 'Lampirkan Pelanggan',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
            ],
        ],
        'brands' => [
            'title' => 'Merek',
            'description' => 'Pilih merek mana yang harus dibatasi untuk diskon ini.',
            'actions' => [
                'attach' => [
                    'label' => 'Lampirkan Merek',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'type' => [
                    'label' => 'Tipe',
                    'limitation' => [
                        'label' => 'Pembatasan',
                    ],
                    'exclusion' => [
                        'label' => 'Pengecualian',
                    ],
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
        'products' => [
            'title' => 'Produk',
            'description' => 'Pilih produk mana yang harus dibatasi untuk diskon ini.',
            'actions' => [
                'attach' => [
                    'label' => 'Tambah Produk',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'type' => [
                    'label' => 'Tipe',
                    'limitation' => [
                        'label' => 'Pembatasan',
                    ],
                    'exclusion' => [
                        'label' => 'Pengecualian',
                    ],
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
        'rewards' => [
            'title' => 'Hadiah',
            'description' => 'Pilih produk mana yang akan didiskon jika ada di keranjang dan kondisi di atas terpenuhi.',
            'actions' => [
                'attach' => [
                    'label' => 'Tambah Hadiah',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'type' => [
                    'label' => 'Tipe',
                    'limitation' => [
                        'label' => 'Pembatasan',
                    ],
                    'exclusion' => [
                        'label' => 'Pengecualian',
                    ],
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
        'conditions' => [
            'title' => 'Kondisi Produk dan Varian',
            'description' => 'Pilih kondisi produk atau varian yang diperlukan agar diskon diterapkan.',
            'actions' => [
                'attach' => [
                    'label' => 'Tambah Kondisi',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'type' => [
                    'label' => 'Tipe',
                    'limitation' => [
                        'label' => 'Pembatasan',
                    ],
                    'exclusion' => [
                        'label' => 'Pengecualian',
                    ],
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
        'collection_conditions' => [
            'title' => 'Kondisi Koleksi',
            'description' => 'Pilih kondisi koleksi yang diperlukan agar diskon diterapkan.',
            'actions' => [
                'attach' => [
                    'label' => 'Tambah Kondisi',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
            ],
        ],
        'productvariants' => [
            'title' => 'Varian Produk',
            'description' => 'Pilih varian produk mana yang harus dibatasi untuk diskon ini.',
            'actions' => [
                'attach' => [
                    'label' => 'Tambah Varian Produk',
                ],
            ],
            'table' => [
                'name' => [
                    'label' => 'Nama',
                ],
                'sku' => [
                    'label' => 'SKU',
                ],
                'values' => [
                    'label' => 'Opsi',
                ],
            ],
            'form' => [
                'type' => [
                    'options' => [
                        'limitation' => [
                            'label' => 'Pembatasan',
                        ],
                        'exclusion' => [
                            'label' => 'Pengecualian',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
