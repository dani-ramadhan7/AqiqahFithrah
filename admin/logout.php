<?php

declare(strict_types=1);

require __DIR__ . '/auth.php';

logoutAdmin();
header('Location: login.php');
exit;
