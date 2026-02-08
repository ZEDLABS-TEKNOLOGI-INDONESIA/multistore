<?php

return [
    'non_purchasable_item' => 'Model ":class" tidak mengimplementasikan interface purchasable.',
    'cart_line_id_mismatch' => 'Item keranjang ini tidak termasuk dalam keranjang ini',
    'invalid_cart_line_quantity' => 'Jumlah yang diharapkan minimal "1", ditemukan ":quantity".',
    'maximum_cart_line_quantity' => 'Jumlah tidak boleh melebihi :quantity.',
    'carts.invalid_action' => 'Tindakan keranjang tidak valid',
    'carts.shipping_missing' => 'Alamat pengiriman diperlukan',
    'carts.billing_missing' => 'Alamat penagihan diperlukan',
    'carts.billing_incomplete' => 'Alamat penagihan tidak lengkap',
    'carts.order_exists' => 'Pesanan untuk keranjang ini sudah ada',
    'carts.shipping_option_missing' => 'Opsi Pengiriman Tidak Ditemukan',
    'missing_currency_price' => 'Tidak ada harga untuk mata uang ":currency"',
    'minimum_quantity' => 'Anda harus menambahkan minimal :quantity item.',
    'quantity_increment' => 'Jumlah :quantity harus dalam kelipatan :increment',
    'fieldtype_missing' => 'FieldType ":class" tidak ada',
    'invalid_fieldtype' => 'Class ":class" tidak mengimplementasikan interface FieldType.',
    'discounts.invalid_type' => 'Koleksi hanya boleh berisi ":expected", ditemukan ":actual"',
    'disallow_multiple_cart_orders' => 'Keranjang hanya dapat memiliki satu pesanan yang terkait.',
];
