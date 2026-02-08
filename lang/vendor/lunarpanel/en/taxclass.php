<?php
return [
    'label' => 'Kelas Pajak',
    'plural_label' => 'Kelas Pajak',
    'table' => [
        'name' => [
            'label' => 'Nama',
        ],
        'default' => [
            'label' => 'Default',
        ],
    ],
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
        'default' => [
            'label' => 'Default',
        ],
    ],
    'delete' => [
        'error' => [
            'title' => 'Tidak dapat menghapus kelas pajak',
            'body' => 'Kelas pajak ini memiliki varian produk yang terkait dan tidak dapat dihapus.',
        ],
    ],
];
