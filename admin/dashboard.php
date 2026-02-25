<?php

declare(strict_types=1);

require __DIR__ . '/auth.php';
requireAdminAuthentication();
require_once __DIR__ . '/../poster_data.php';

/**
 * @param array<int, array<string, int|string>> $packages
 */
function findPackageIndexById(array $packages, string $id): ?int
{
    foreach ($packages as $index => $package) {
        if ((string) ($package['id'] ?? '') === $id) {
            return $index;
        }
    }

    return null;
}

/**
 * @param array<int, array<string, int|string>> $packages
 */
function nasiBoxExistsByBox(array $packages, int $box, ?string $excludeId = null): bool
{
    foreach ($packages as $package) {
        if ((int) ($package['box'] ?? 0) === $box && (string) ($package['id'] ?? '') !== $excludeId) {
            return true;
        }
    }

    return false;
}

/**
 * @param array<int, array<string, int|string>> $packages
 */
function matanganExistsByName(array $packages, string $name, ?string $excludeId = null): bool
{
    $target = strtolower($name);
    foreach ($packages as $package) {
        $packageName = strtolower(trim((string) ($package['name'] ?? '')));
        if ($packageName === $target && (string) ($package['id'] ?? '') !== $excludeId) {
            return true;
        }
    }

    return false;
}

function parsePositiveInt(string $value): ?int
{
    $parsed = (int) preg_replace('/\D+/', '', $value);
    if ($parsed <= 0) {
        return null;
    }

    return $parsed;
}

function normalizePackageName(string $name): string
{
    $normalized = preg_replace('/\s+/', ' ', trim($name));
    return $normalized ?? '';
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$nasiBoxPackages = $posterData['nasi_box_packages'];
$matanganPackages = $posterData['matangan_packages'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = (string) ($_POST['csrf_token'] ?? '');
    $action = (string) ($_POST['action'] ?? '');

    if (!verifyCsrfToken($csrfToken)) {
        setFlashMessage('danger', 'Sesi form tidak valid. Silakan coba lagi.');
        header('Location: dashboard.php');
        exit;
    }

    try {
        switch ($action) {
            case 'add_nasi_box':
                $box = parsePositiveInt((string) ($_POST['box'] ?? ''));
                $price = parsePositiveInt((string) ($_POST['price'] ?? ''));

                if ($box === null || $price === null) {
                    throw new InvalidArgumentException('Data paket nasi box tidak valid.');
                }
                if (nasiBoxExistsByBox($nasiBoxPackages, $box)) {
                    throw new InvalidArgumentException('Nomor box untuk paket nasi box sudah digunakan.');
                }

                $nasiBoxPackages[] = [
                    'id' => generatePackageId('nb'),
                    'box' => $box,
                    'price' => $price,
                ];
                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket nasi box berhasil ditambahkan.');
                break;

            case 'update_nasi_box':
                $id = trim((string) ($_POST['id'] ?? ''));
                $box = parsePositiveInt((string) ($_POST['box'] ?? ''));
                $price = parsePositiveInt((string) ($_POST['price'] ?? ''));
                $index = findPackageIndexById($nasiBoxPackages, $id);

                if ($id === '' || $index === null || $box === null || $price === null) {
                    throw new InvalidArgumentException('Data update paket nasi box tidak valid.');
                }
                if (nasiBoxExistsByBox($nasiBoxPackages, $box, $id)) {
                    throw new InvalidArgumentException('Nomor box untuk paket nasi box sudah digunakan.');
                }

                $nasiBoxPackages[$index]['box'] = $box;
                $nasiBoxPackages[$index]['price'] = $price;
                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket nasi box berhasil diperbarui.');
                break;

            case 'delete_nasi_box':
                $id = trim((string) ($_POST['id'] ?? ''));
                $beforeCount = count($nasiBoxPackages);
                $nasiBoxPackages = array_values(
                    array_filter(
                        $nasiBoxPackages,
                        static fn(array $package): bool => (string) ($package['id'] ?? '') !== $id
                    )
                );

                if ($id === '' || count($nasiBoxPackages) === $beforeCount) {
                    throw new InvalidArgumentException('Paket nasi box tidak ditemukan.');
                }

                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket nasi box berhasil dihapus.');
                break;

            case 'add_matangan':
                $name = normalizePackageName((string) ($_POST['name'] ?? ''));
                $sate = parsePositiveInt((string) ($_POST['sate'] ?? ''));
                $gulai = parsePositiveInt((string) ($_POST['gulai'] ?? ''));
                $price = parsePositiveInt((string) ($_POST['price'] ?? ''));

                if ($name === '' || $sate === null || $gulai === null || $price === null) {
                    throw new InvalidArgumentException('Data paket matangan tidak valid.');
                }
                if (matanganExistsByName($matanganPackages, $name)) {
                    throw new InvalidArgumentException('Nama paket matangan sudah digunakan.');
                }

                $matanganPackages[] = [
                    'id' => generatePackageId('mt'),
                    'name' => $name,
                    'sate' => $sate,
                    'gulai' => $gulai,
                    'price' => $price,
                ];
                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket matangan berhasil ditambahkan.');
                break;

            case 'update_matangan':
                $id = trim((string) ($_POST['id'] ?? ''));
                $name = normalizePackageName((string) ($_POST['name'] ?? ''));
                $sate = parsePositiveInt((string) ($_POST['sate'] ?? ''));
                $gulai = parsePositiveInt((string) ($_POST['gulai'] ?? ''));
                $price = parsePositiveInt((string) ($_POST['price'] ?? ''));
                $index = findPackageIndexById($matanganPackages, $id);

                if ($id === '' || $index === null || $name === '' || $sate === null || $gulai === null || $price === null) {
                    throw new InvalidArgumentException('Data update paket matangan tidak valid.');
                }
                if (matanganExistsByName($matanganPackages, $name, $id)) {
                    throw new InvalidArgumentException('Nama paket matangan sudah digunakan.');
                }

                $matanganPackages[$index]['name'] = $name;
                $matanganPackages[$index]['sate'] = $sate;
                $matanganPackages[$index]['gulai'] = $gulai;
                $matanganPackages[$index]['price'] = $price;
                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket matangan berhasil diperbarui.');
                break;

            case 'delete_matangan':
                $id = trim((string) ($_POST['id'] ?? ''));
                $beforeCount = count($matanganPackages);
                $matanganPackages = array_values(
                    array_filter(
                        $matanganPackages,
                        static fn(array $package): bool => (string) ($package['id'] ?? '') !== $id
                    )
                );

                if ($id === '' || count($matanganPackages) === $beforeCount) {
                    throw new InvalidArgumentException('Paket matangan tidak ditemukan.');
                }

                savePackageCollections($nasiBoxPackages, $matanganPackages);
                setFlashMessage('success', 'Paket matangan berhasil dihapus.');
                break;

            default:
                throw new InvalidArgumentException('Aksi tidak dikenali.');
        }
    } catch (Throwable $throwable) {
        setFlashMessage('danger', $throwable->getMessage());
    }

    header('Location: dashboard.php');
    exit;
}

$flashMessage = consumeFlashMessage();
$csrfToken = getCsrfToken();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Aqiqah Fithrah</title>
    <link rel="icon" type="image/jpeg" href="../image/icon_aqiqah.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-warning-subtle border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Dashboard Admin</a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span class="text-muted small">Login sebagai <?= h(getAuthenticatedAdminName()); ?></span>
                <a class="btn btn-sm btn-outline-secondary" href="../index.php" target="_blank" rel="noopener">Lihat Website</a>
                <a class="btn btn-sm btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php if ($flashMessage !== null): ?>
            <div class="alert alert-<?= h($flashMessage['type']); ?>" role="alert">
                <?= h($flashMessage['message']); ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h1 class="h4 mb-0">CRUD Paket Nasi Box</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Box</th>
                                        <th>Harga (Rp)</th>
                                        <th width="220">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nasiBoxPackages as $package): ?>
                                        <?php $formId = 'nasi_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', (string) $package['id']); ?>
                                        <tr>
                                            <td>
                                                <form id="<?= h($formId); ?>" method="post" class="d-none">
                                                    <input type="hidden" name="csrf_token" value="<?= h($csrfToken); ?>">
                                                    <input type="hidden" name="id" value="<?= h((string) $package['id']); ?>">
                                                </form>
                                                <input
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    name="box"
                                                    min="1"
                                                    value="<?= h((string) $package['box']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td>
                                                <input
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    name="price"
                                                    min="1"
                                                    step="1"
                                                    value="<?= h((string) $package['price']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td class="text-nowrap">
                                                <button type="submit" name="action" value="update_nasi_box" form="<?= h($formId); ?>" class="btn btn-sm btn-success">
                                                    Simpan
                                                </button>
                                                <button type="submit" name="action" value="delete_nasi_box" form="<?= h($formId); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus paket ini?');">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <h2 class="h6 mb-3">Tambah Paket Nasi Box</h2>
                        <form method="post" class="row g-2 align-items-end">
                            <input type="hidden" name="csrf_token" value="<?= h($csrfToken); ?>">
                            <input type="hidden" name="action" value="add_nasi_box">
                            <div class="col-sm-4">
                                <label for="new_box" class="form-label">Jumlah Box</label>
                                <input type="number" class="form-control" id="new_box" name="box" min="1" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="new_price_nasi" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" id="new_price_nasi" name="price" min="1" step="1" required>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-warning w-100">Tambah Paket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h2 class="h4 mb-0">CRUD Paket Matangan</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Sate (Tusuk)</th>
                                        <th>Gulai (Porsi)</th>
                                        <th>Harga (Rp)</th>
                                        <th width="220">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($matanganPackages as $package): ?>
                                        <?php $formId = 'matangan_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', (string) $package['id']); ?>
                                        <tr>
                                            <td>
                                                <form id="<?= h($formId); ?>" method="post" class="d-none">
                                                    <input type="hidden" name="csrf_token" value="<?= h($csrfToken); ?>">
                                                    <input type="hidden" name="id" value="<?= h((string) $package['id']); ?>">
                                                </form>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    name="name"
                                                    value="<?= h((string) $package['name']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td>
                                                <input
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    name="sate"
                                                    min="1"
                                                    value="<?= h((string) $package['sate']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td>
                                                <input
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    name="gulai"
                                                    min="1"
                                                    value="<?= h((string) $package['gulai']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td>
                                                <input
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    name="price"
                                                    min="1"
                                                    step="1"
                                                    value="<?= h((string) $package['price']); ?>"
                                                    form="<?= h($formId); ?>"
                                                    required>
                                            </td>
                                            <td class="text-nowrap">
                                                <button type="submit" name="action" value="update_matangan" form="<?= h($formId); ?>" class="btn btn-sm btn-success">
                                                    Simpan
                                                </button>
                                                <button type="submit" name="action" value="delete_matangan" form="<?= h($formId); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus paket ini?');">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <h2 class="h6 mb-3">Tambah Paket Matangan</h2>
                        <form method="post" class="row g-2 align-items-end">
                            <input type="hidden" name="csrf_token" value="<?= h($csrfToken); ?>">
                            <input type="hidden" name="action" value="add_matangan">
                            <div class="col-md-3">
                                <label for="new_name_matangan" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" id="new_name_matangan" name="name" required>
                            </div>
                            <div class="col-md-2">
                                <label for="new_sate_matangan" class="form-label">Sate</label>
                                <input type="number" class="form-control" id="new_sate_matangan" name="sate" min="1" required>
                            </div>
                            <div class="col-md-2">
                                <label for="new_gulai_matangan" class="form-label">Gulai</label>
                                <input type="number" class="form-control" id="new_gulai_matangan" name="gulai" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="new_price_matangan" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" id="new_price_matangan" name="price" min="1" step="1" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-warning w-100">Tambah Paket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
