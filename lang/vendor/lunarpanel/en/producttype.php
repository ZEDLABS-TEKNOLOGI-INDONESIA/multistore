<?php
return [
    'label' => 'Tipe Produk',
    'plural_label' => 'Tipe Produk',
    'table' => [
        'name' => [
            'label' => 'Nama',
        ],
        'products_count' => [
            'label' => 'Jumlah Produk',
        ],
        'product_attributes_count' => [
            'label' => 'Atribut Produk',
        ],
        'variant_attributes_count' => [
            'label' => 'Atribut Varian',
        ],
    ],
    'tabs' => [
        'product_attributes' => [
            'label' => 'Atribut Produk',
        ],
        'variant_attributes' => [
            'label' => 'Atribut Varian',
        ],
    ],
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
    ],
    'attributes' => [
        'no_groups' => 'Tidak ada grup atribut yang tersedia.',
        'no_attributes' => 'Tidak ada atribut yang tersedia.',
    ],
    'action' => [
        'delete' => [
            'notification' => [
                'error_protected' => 'Tipe produk ini tidak dapat dihapus karena masih terdapat produk yang terkait.',
            ],
        ],
    ],
];
