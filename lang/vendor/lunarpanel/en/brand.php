<?php
return [
    'label' => 'Merek',
    'plural_label' => 'Merek',
    'table' => [
        'name' => [
            'label' => 'Nama',
        ],
        'products_count' => [
            'label' => 'Jumlah Produk',
        ],
    ],
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
    ],
    'action' => [
        'delete' => [
            'notification' => [
                'error_protected' => 'Merek ini tidak dapat dihapus karena masih terdapat produk yang terkait.',
            ],
        ],
    ],
    'pages' => [
        'edit' => [
            'title' => 'Informasi Dasar',
        ],
        'products' => [
            'label' => 'Produk',
            'actions' => [
                'attach' => [
                    'label' => 'Kaitkan produk',
                    'form' => [
                        'record_id' => [
                            'label' => 'Produk',
                        ],
                    ],
                    'notification' => [
                        'success' => 'Produk berhasil dikaitkan ke merek',
                    ],
                ],
                'detach' => [
                    'notification' => [
                        'success' => 'Produk berhasil dilepaskan.',
                    ],
                ],
            ],
        ],
        'collections' => [
            'label' => 'Koleksi',
            'table' => [
                'header_actions' => [
                    'attach' => [
                        'record_select' => [
                            'placeholder' => 'Pilih koleksi',
                        ],
                    ],
                ],
            ],
            'actions' => [
                'attach' => [
                    'label' => 'Kaitkan koleksi',
                ],
            ],
        ],
    ],
];
