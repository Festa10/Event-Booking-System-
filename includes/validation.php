<?php

// Validate email with RegEx
function validateEmail(string $email): bool {
return (bool) preg_match('/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/', trim($em
}
function validatePhone(string $phone): bool {
$phone = trim($phone);
return (bool) preg_match('/^(\+?3836[789]\d{6}|04[3-9]\d{6}|\+?[1-9]\d{7,14})$/', preg_re
}

function sanitizeInput(string $input): string {
return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function validateRequired(string $value): bool {
return trim($value) !== '';
}

function validateName(string $name): bool {
return (bool) preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿëçÇ\s\-]{2,60}$/u', trim($name));
}

function getPostData(array $fields): array {
$data = [];
foreach ($fields as $field) {
$data[$field] = isset($_POST[$field]) ? sanitizeInput($_POST[$field]) : '';
}
return $data;
}

function validateContactForm(array $data): array {
$errors = [];
if (!validateRequired($data['name'])) {
$errors['name'] = 'Emri është i detyrueshëm.';
} elseif (!validateName($data['name'])) {
$errors['name'] = 'Emri përmban karaktere të pavlefshme.';
}
if (!validateRequired($data['email'])) {
$errors['email'] = 'Email-i është i detyrueshëm.';
} elseif (!validateEmail($data['email'])) {
$errors['email'] = 'Adresa e email-it nuk është e vlefshme.';
}
if (!validateRequired($data['phone'])) {
$errors['phone'] = 'Numri i telefonit është i detyrueshëm.';
} elseif (!validatePhone($data['phone'])) {
$errors['phone'] = 'Numri i telefonit nuk është i vlefshëm.';
}
if (!validateRequired($data['message'])) {
$errors['message'] = 'Mesazhi është i detyrueshëm.';
} elseif (mb_strlen($data['message']) < 10) {
$errors['message'] = 'Mesazhi duhet të ketë të paktën 10 karaktere.';
}
return $errors;
}
