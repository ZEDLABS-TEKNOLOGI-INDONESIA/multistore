<?php
return [
    'label' => 'Zona Pajak',
    'plural_label' => 'Zona Pajak',
    'table' => [
        'name' => [
            'label' => 'Nama',
        ],
        'zone_type' => [
            'label' => 'Tipe Zona',
        ],
        'active' => [
            'label' => 'Aktif',
        ],
        'default' => [
            'label' => 'Default',
        ],
    ],
    'form' => [
        'name' => [
            'label' => 'Nama',
        ],
        'zone_type' => [
            'label' => 'Tipe Zona',
            'options' => [
                'country' => 'Batasi ke Negara',
                'states' => 'Batasi ke Provinsi',
                'postcodes' => 'Batasi ke Kode Pos',
            ],
        ],
        'price_display' => [
            'label' => 'Tampilan Harga',
            'options' => [
                'include_tax' => 'Termasuk Pajak',
                'exclude_tax' => 'Tidak Termasuk Pajak',
            ],
        ],
        'active' => [
            'label' => 'Aktif',
        ],
        'default' => [
            'label' => 'Default',
        ],
        'zone_countries' => [
            'label' => 'Negara',
        ],
        'zone_country' => [
            'label' => 'Negara',
        ],
        'zone_states' => [
            'label' => 'Provinsi',
        ],
        'zone_postcodes' => [
            'label' => 'Kode Pos',
            'helper' => 'Daftar setiap kode pos pada baris baru. Mendukung wildcard seperti NW*',
        ],
    ],
];
