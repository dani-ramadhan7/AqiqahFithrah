<?php

declare(strict_types=1);

require __DIR__ . '/auth.php';

if (isAdminAuthenticated()) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;
