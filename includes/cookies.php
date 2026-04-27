<?php
/**
*/
* Cookie Helper Functions – Personalizim
* Personi 4 – Validimi & Shtesat
define('COOKIE_PREFIX', 'vp4_');
define('COOKIE_LIFETIME', 30 * 24 * 60 * 60); // 30 days in seconds

function setCookie_(string $name, string $value, int $lifetime = COOKIE_LIFETIME): void {
setcookie(
COOKIE_PREFIX . $name,
$value,
[
'expires' => time() + $lifetime,
'path' => '/',
'secure' => isset($_SERVER['HTTPS']),
'httponly' => true,
'samesite' => 'Lax',
]
);

$_COOKIE[COOKIE_PREFIX . $name] = $value;
}
// Get a cookie value (returns default if not set)
function getCookie_(string $name, string $default = ''): string {
return $_COOKIE[COOKIE_PREFIX . $name] ?? $default;
}
// Delete a cookie
function deleteCookie_(string $name): void {
setcookie(COOKIE_PREFIX . $name, '', ['expires' => time() - 3600, 'path' => '/']);
unset($_COOKIE[COOKIE_PREFIX . $name]);
}
// Check if a cookie exists
function hasCookie_(string $name): bool {
return isset($_COOKIE[COOKIE_PREFIX . $name]);
}
// Save contact form data to cookies 
function saveFormCookies(array $data): void {
$saveable = ['name', 'email', 'phone'];
foreach ($saveable as $field) {
if (!empty($data[$field])) {
setCookie_($field, $data[$field]);
}
}
}

function loadFormCookies(): array {
return [
'name' => getCookie_('name'),
'email' => getCookie_('email'),
'phone' => getCookie_('phone'),
];
}

function hasCookieConsent(): bool {
return getCookie_('consent') === 'accepted';
}

function acceptCookieConsent(): void {
setCookie_('consent', 'accepted');
}
