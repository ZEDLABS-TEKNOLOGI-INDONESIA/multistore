<?php
return [
    'collections' => [
        'create_root' => [
            'label' => 'Buat Koleksi Utama',
        ],
        'create_child' => [
            'label' => 'Buat Koleksi Turunan',
        ],
        'move' => [
            'label' => 'Pindahkan Koleksi',
        ],
        'delete' => [
            'label' => 'Hapus',
            'notifications' => [
                'cannot_delete' => [
                    'title' => 'Tidak Dapat Menghapus',
                    'body' => 'Koleksi ini memiliki koleksi turunan dan tidak dapat dihapus.',
                ],
            ],
        ],
    ],
    'orders' => [
        'update_status' => [
            'label' => 'Perbarui Status',
            'wizard' => [
                'step_one' => [
                    'label' => 'Status',
                ],
                'step_two' => [
                    'label' => 'Email & Notifikasi',
                    'no_mailers' => 'Tidak ada email yang tersedia untuk status ini.',
                ],
                'step_three' => [
                    'label' => 'Pratinjau & Simpan',
                    'no_mailers' => 'Tidak ada email yang dipilih untuk pratinjau.',
                ],
            ],
            'notification' => [
                'label' => 'Status pesanan diperbarui',
            ],
            'billing_email' => [
                'label' => 'Email Penagihan',
            ],
            'shipping_email' => [
                'label' => 'Email Pengiriman',
            ],
        ],
    ],
];
