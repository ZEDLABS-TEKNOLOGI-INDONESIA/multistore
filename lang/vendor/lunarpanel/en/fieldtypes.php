<?php
return [
    'dropdown' => [
        'label' => 'Dropdown',
        'form' => [
            'lookups' => [
                'label' => 'Pencarian',
                'key_label' => 'Label',
                'value_label' => 'Nilai',
            ],
        ],
    ],
    'listfield' => [
        'label' => 'Field Daftar',
    ],
    'text' => [
        'label' => 'Teks',
        'form' => [
            'richtext' => [
                'label' => 'Teks Kaya',
            ],
        ],
    ],
    'translatedtext' => [
        'label' => 'Teks Terjemahan',
        'form' => [
            'richtext' => [
                'label' => 'Teks Kaya',
            ],
            'locales' => 'Lokal',
        ],
    ],
    'toggle' => [
        'label' => 'Toggle',
    ],
    'youtube' => [
        'label' => 'YouTube',
    ],
    'vimeo' => [
        'label' => 'Vimeo',
    ],
    'number' => [
        'label' => 'Angka',
        'form' => [
            'min' => [
                'label' => 'Min.',
            ],
            'max' => [
                'label' => 'Maks.',
            ],
        ],
    ],
    'file' => [
        'label' => 'File',
        'form' => [
            'file_types' => [
                'label' => 'Tipe File yang Diizinkan',
                'placeholder' => 'MIME Baru',
            ],
            'multiple' => [
                'label' => 'Izinkan Multiple File',
            ],
            'min_files' => [
                'label' => 'File Min.',
            ],
            'max_files' => [
                'label' => 'File Maks.',
            ],
        ],
    ],
];
