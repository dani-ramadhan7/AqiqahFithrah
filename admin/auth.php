<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * @return array{username: string, password_hash: string}
 */
function getAdminCredentials(): array
{
    static $credentials = null;
    if ($credentials === null) {
        $credentials = require __DIR__ . '/../config/admin.php';
    }

    return $credentials;
}

function isAdminAuthenticated(): bool
{
    return isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true;
}

function getAuthenticatedAdminName(): string
{
    if (isset($_SESSION['admin_username']) && is_string($_SESSION['admin_username']) && $_SESSION['admin_username'] !== '') {
        return $_SESSION['admin_username'];
    }

    return 'Admin';
}

function authenticateAdmin(string $username, string $password): bool
{
    $credentials = getAdminCredentials();
    $usernameMatches = hash_equals($credentials['username'], $username);
    if (!$usernameMatches) {
        return false;
    }

    return password_verify($password, $credentials['password_hash']);
}

function loginAdmin(string $username): void
{
    session_regenerate_id(true);
    $_SESSION['admin_authenticated'] = true;
    $_SESSION['admin_username'] = $username;
}

function requireAdminAuthentication(): void
{
    if (!isAdminAuthenticated()) {
        header('Location: login.php');
        exit;
    }
}

function logoutAdmin(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            (bool) $params['secure'],
            (bool) $params['httponly']
        );
    }

    session_destroy();
}

function getCsrfToken(): string
{
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || $_SESSION['csrf_token'] === '') {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(string $token): bool
{
    $sessionToken = $_SESSION['csrf_token'] ?? '';
    if (!is_string($sessionToken) || $sessionToken === '') {
        return false;
    }

    return hash_equals($sessionToken, $token);
}

function setFlashMessage(string $type, string $message): void
{
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message,
    ];
}

/**
 * @return array{type: string, message: string}|null
 */
function consumeFlashMessage(): ?array
{
    if (!isset($_SESSION['flash_message']) || !is_array($_SESSION['flash_message'])) {
        return null;
    }

    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);

    if (!isset($flashMessage['type'], $flashMessage['message'])) {
        return null;
    }

    return [
        'type' => (string) $flashMessage['type'],
        'message' => (string) $flashMessage['message'],
    ];
}
