<?php

declare(strict_types=1);

require __DIR__ . '/auth.php';

if (isAdminAuthenticated()) {
    header('Location: dashboard.php');
    exit;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$errorMessage = '';
$submittedUsername = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = (string) ($_POST['csrf_token'] ?? '');
    $submittedUsername = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!verifyCsrfToken($csrfToken)) {
        $errorMessage = 'Sesi login tidak valid. Silakan refresh halaman.';
    } elseif ($submittedUsername === '' || $password === '') {
        $errorMessage = 'Username dan password wajib diisi.';
    } elseif (!authenticateAdmin($submittedUsername, $password)) {
        $errorMessage = 'Username atau password salah.';
    } else {
        loginAdmin($submittedUsername);
        setFlashMessage('success', 'Login berhasil.');
        header('Location: dashboard.php');
        exit;
    }
}

$csrfToken = getCsrfToken();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Aqiqah Fithrah</title>
    <link rel="icon" type="image/jpeg" href="../image/icon_aqiqah.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h3 mb-3 text-center">Login Admin</h1>
                        <p class="text-muted text-center mb-4">Dashboard CRUD paket Aqiqah Fithrah</p>

                        <?php if ($errorMessage !== ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= h($errorMessage); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <input type="hidden" name="csrf_token" value="<?= h($csrfToken); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="<?= h($submittedUsername); ?>"
                                    required
                                    autocomplete="username">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password">
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Login</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="../index.php" class="link-secondary">Kembali ke Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
