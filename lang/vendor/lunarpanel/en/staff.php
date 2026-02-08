<?php
return [
    'label' => 'Staf',
    'plural_label' => 'Staf',
    'table' => [
        'first_name' => [
            'label' => 'Nama Depan',
        ],
        'last_name' => [
            'label' => 'Nama Belakang',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'admin' => [
            'badge' => 'Super Admin',
        ],
    ],
    'form' => [
        'first_name' => [
            'label' => 'Nama Depan',
        ],
        'last_name' => [
            'label' => 'Nama Belakang',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'password' => [
            'label' => 'Kata Sandi',
            'hint' => 'Reset kata sandi',
        ],
        'admin' => [
            'label' => 'Super Admin',
            'helper' => 'Peran super admin tidak dapat diubah di hub.',
        ],
        'roles' => [
            'label' => 'Peran',
            'helper' => ':roles memiliki akses penuh',
        ],
        'permissions' => [
            'label' => 'Izin',
        ],
        'role' => [
            'label' => 'Nama Peran',
        ],
    ],
    'action' => [
        'acl' => [
            'label' => 'Kontrol Akses',
        ],
        'add-role' => [
            'label' => 'Tambah Peran',
        ],
        'delete-role' => [
            'label' => 'Hapus Peran',
            'heading' => 'Hapus peran: :role',
        ],
    ],
    'acl' => [
        'title' => 'Kontrol Akses',
        'tooltip' => [
            'roles-included' => 'Izin termasuk dalam peran berikut',
        ],
        'notification' => [
            'updated' => 'Diperbarui',
            'error' => 'Kesalahan',
            'no-role' => 'Peran tidak terdaftar di Lunar',
            'no-permission' => 'Izin tidak terdaftar di Lunar',
            'no-role-permission' => 'Peran dan Izin tidak terdaftar di Lunar',
        ],
    ],
];
