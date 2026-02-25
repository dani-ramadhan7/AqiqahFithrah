<?php

declare(strict_types=1);

function getPackageDataFilePath(): string
{
    return __DIR__ . '/../data/packages.json';
}

/**
 * @param array<int, array<string, mixed>> $defaultNasiBoxPackages
 * @param array<int, array<string, mixed>> $defaultMatanganPackages
 * @return array{nasi_box_packages: array<int, array<string, int|string>>, matangan_packages: array<int, array<string, int|string>>}
 */
function loadPackageCollections(array $defaultNasiBoxPackages, array $defaultMatanganPackages): array
{
    $fallbackNasiBoxPackages = normalizeNasiBoxPackageList($defaultNasiBoxPackages);
    $fallbackMatanganPackages = normalizeMatanganPackageList($defaultMatanganPackages);

    $filePath = getPackageDataFilePath();
    if (!is_file($filePath)) {
        return [
            'nasi_box_packages' => $fallbackNasiBoxPackages,
            'matangan_packages' => $fallbackMatanganPackages,
        ];
    }

    $rawContent = file_get_contents($filePath);
    if ($rawContent === false) {
        return [
            'nasi_box_packages' => $fallbackNasiBoxPackages,
            'matangan_packages' => $fallbackMatanganPackages,
        ];
    }

    $decoded = json_decode($rawContent, true);
    if (!is_array($decoded)) {
        return [
            'nasi_box_packages' => $fallbackNasiBoxPackages,
            'matangan_packages' => $fallbackMatanganPackages,
        ];
    }

    $nasiBoxPackages = [];
    if (isset($decoded['nasi_box_packages']) && is_array($decoded['nasi_box_packages'])) {
        $nasiBoxPackages = normalizeNasiBoxPackageList($decoded['nasi_box_packages']);
    }

    $matanganPackages = [];
    if (isset($decoded['matangan_packages']) && is_array($decoded['matangan_packages'])) {
        $matanganPackages = normalizeMatanganPackageList($decoded['matangan_packages']);
    }

    return [
        'nasi_box_packages' => $nasiBoxPackages !== [] ? $nasiBoxPackages : $fallbackNasiBoxPackages,
        'matangan_packages' => $matanganPackages !== [] ? $matanganPackages : $fallbackMatanganPackages,
    ];
}

/**
 * @param array<int, array<string, mixed>> $nasiBoxPackages
 * @param array<int, array<string, mixed>> $matanganPackages
 */
function savePackageCollections(array $nasiBoxPackages, array $matanganPackages): void
{
    $normalizedNasiBoxPackages = normalizeNasiBoxPackageList($nasiBoxPackages);
    $normalizedMatanganPackages = normalizeMatanganPackageList($matanganPackages);

    $payload = [
        'nasi_box_packages' => $normalizedNasiBoxPackages,
        'matangan_packages' => $normalizedMatanganPackages,
    ];

    $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    if ($encoded === false) {
        throw new RuntimeException('Gagal memproses data paket.');
    }

    $filePath = getPackageDataFilePath();
    $directoryPath = dirname($filePath);
    if (!is_dir($directoryPath) && !mkdir($directoryPath, 0777, true) && !is_dir($directoryPath)) {
        throw new RuntimeException('Gagal membuat folder penyimpanan paket.');
    }

    $writeResult = file_put_contents($filePath, $encoded . PHP_EOL, LOCK_EX);
    if ($writeResult === false) {
        throw new RuntimeException('Gagal menyimpan data paket.');
    }
}

function generatePackageId(string $prefix): string
{
    return $prefix . '_' . bin2hex(random_bytes(5));
}

/**
 * @param array<int, mixed> $packages
 * @return array<int, array<string, int|string>>
 */
function normalizeNasiBoxPackageList(array $packages): array
{
    $normalized = [];
    foreach ($packages as $package) {
        if (!is_array($package)) {
            continue;
        }

        $item = normalizeNasiBoxPackage($package);
        if ($item !== null) {
            $normalized[] = $item;
        }
    }

    usort(
        $normalized,
        static fn(array $first, array $second): int => (int) $first['box'] <=> (int) $second['box']
    );

    return $normalized;
}

/**
 * @param array<int, mixed> $packages
 * @return array<int, array<string, int|string>>
 */
function normalizeMatanganPackageList(array $packages): array
{
    $normalized = [];
    foreach ($packages as $package) {
        if (!is_array($package)) {
            continue;
        }

        $item = normalizeMatanganPackage($package);
        if ($item !== null) {
            $normalized[] = $item;
        }
    }

    usort(
        $normalized,
        static fn(array $first, array $second): int => (int) $first['sate'] <=> (int) $second['sate']
    );

    return $normalized;
}

/**
 * @param array<string, mixed> $package
 * @return array<string, int|string>|null
 */
function normalizeNasiBoxPackage(array $package): ?array
{
    $id = isset($package['id']) ? trim((string) $package['id']) : '';
    $box = isset($package['box']) ? (int) $package['box'] : 0;
    $price = isset($package['price']) ? (int) $package['price'] : 0;

    if ($id === '') {
        $id = generatePackageId('nb');
    }

    if ($box <= 0 || $price <= 0) {
        return null;
    }

    return [
        'id' => $id,
        'box' => $box,
        'price' => $price,
    ];
}

/**
 * @param array<string, mixed> $package
 * @return array<string, int|string>|null
 */
function normalizeMatanganPackage(array $package): ?array
{
    $id = isset($package['id']) ? trim((string) $package['id']) : '';
    $name = isset($package['name']) ? trim((string) $package['name']) : '';
    $sate = isset($package['sate']) ? (int) $package['sate'] : 0;
    $gulai = isset($package['gulai']) ? (int) $package['gulai'] : 0;
    $price = isset($package['price']) ? (int) $package['price'] : 0;

    if ($id === '') {
        $id = generatePackageId('mt');
    }

    if ($name === '' || $sate <= 0 || $gulai <= 0 || $price <= 0) {
        return null;
    }

    return [
        'id' => $id,
        'name' => $name,
        'sate' => $sate,
        'gulai' => $gulai,
        'price' => $price,
    ];
}
