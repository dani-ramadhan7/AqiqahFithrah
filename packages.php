<?php

declare(strict_types=1);

require __DIR__ . '/poster_data.php';

header('Content-Type: application/json; charset=utf-8');

$payload = [
    'business' => $posterData['business'],
    'nasi_box_packages' => [],
    'matangan_packages' => [],
    'nasi_box_contents' => $posterData['nasi_box_contents'],
    'matangan_bonus' => $posterData['matangan_bonus'],
    'menu_options' => $posterData['menu_options'],
    'free_delivery' => $posterData['free_delivery'],
];

foreach ($posterData['nasi_box_packages'] as $package) {
    $packageName = 'Paket ' . (int) $package['box'] . ' Box';
    $payload['nasi_box_packages'][] = [
        'box' => (int) $package['box'],
        'price' => (int) $package['price'],
        'price_display' => formatRupiah((int) $package['price']),
        'whatsapp_link' => buildWhatsappPackageLink($packageName),
    ];
}

foreach ($posterData['matangan_packages'] as $package) {
    $packageName = 'Paket ' . $package['name'];
    $payload['matangan_packages'][] = [
        'name' => $package['name'],
        'sate' => (int) $package['sate'],
        'gulai' => (int) $package['gulai'],
        'price' => (int) $package['price'],
        'price_display' => formatRupiah((int) $package['price']),
        'whatsapp_link' => buildWhatsappPackageLink($packageName),
    ];
}

echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
