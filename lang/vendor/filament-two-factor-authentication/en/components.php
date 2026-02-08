<?php
return [
    'enable' => [
        'header' => 'Anda belum mengaktifkan autentikasi dua faktor.',
        'description' => 'Ketika autentikasi dua faktor diaktifkan, Anda akan diminta memasukkan token acak yang aman selama proses autentikasi. Anda dapat mengambil token ini dari aplikasi Google Authenticator di ponsel Anda.',
    ],
    'logout' => [
        'button' => 'Keluar',
    ],
    'enabled' => [
        'header' => 'Anda telah mengaktifkan autentikasi dua faktor.',
        'description' => 'Simpan kode pemulihan ini di pengelola kata sandi yang aman. Kode ini dapat digunakan untuk memulihkan akses ke akun Anda jika perangkat autentikasi dua faktor Anda hilang.',
    ],
    'setup_confirmation' => [
        'header' => 'Selesaikan pengaktifan autentikasi dua faktor.',
        'description' => 'Ketika autentikasi dua faktor diaktifkan, Anda akan diminta memasukkan token acak yang aman selama proses autentikasi. Anda dapat mengambil token ini dari aplikasi Google Authenticator di ponsel Anda.',
        'scan_qr_code' => 'Untuk menyelesaikan pengaktifan autentikasi dua faktor, pindai kode QR berikut menggunakan aplikasi autentikator ponsel Anda atau masukkan kunci pengaturan dan berikan kode OTP yang dihasilkan.',
    ],
    'base' => [
        'wrong_user' => 'Objek pengguna yang terautentikasi harus berupa model Filament Auth agar halaman profil dapat memperbaruinya.',
        'rate_limit_exceeded' => 'Terlalu banyak permintaan',
        'try_again' => 'Silakan coba lagi dalam :seconds detik',
    ],
    '2fa' => [
        'confirm' => 'Konfirmasi',
        'cancel' => 'Batal',
        'enable' => 'Aktifkan',
        'disable' => 'Nonaktifkan',
        'confirm_password' => 'Konfirmasi Kata Sandi',
        'wrong_password' => 'Kata sandi yang diberikan salah.',
        'code' => 'Kode',
        'setup_key' => 'Kunci Pengaturan :setup_key.',
        'current_password' => 'Kata Sandi Saat Ini',
        'regenerate_recovery_codes' => 'Buat Kode Pemulihan Baru',
    ],
    'passkey' => [
        'add' => 'Buat Passkey',
        'name' => 'Nama',
        'added' => 'Passkey berhasil ditambahkan.',
        'login' => 'Masuk dengan Passkey',
    ],
];
