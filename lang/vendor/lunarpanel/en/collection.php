<?php
return [
    'label' => 'Koleksi',
    'plural_label' => 'Koleksi',
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
    ],
    'pages' => [
        'children' => [
            'label' => 'Koleksi Turunan',
            'actions' => [
                'create_child' => [
                    'label' => 'Buat Koleksi Turunan',
                ],
            ],
            'table' => [
                'children_count' => [
                    'label' => 'Jumlah Turunan',
                ],
                'name' => [
                    'label' => 'Nama',
                ],
            ],
        ],
        'edit' => [
            'label' => 'Informasi Dasar',
        ],
        'products' => [
            'label' => 'Produk',
            'actions' => [
                'attach' => [
                    'label' => 'Lampirkan Produk',
                ],
            ],
        ],
    ],
];
