<<?php include "../includes/header.php"; ?>

<?php
/**
* contact.php – Contact Page
*/
require_once '../includes/validation.php';
require_once '../includes/cookies.php';
// Handle cookie consent via POST
if (isset($_POST['accept_cookies'])) {
acceptCookieConsent();
header('Location: ' . $_SERVER['PHP_SELF']);
exit;
}
$errors = [];
$success = false;
$fields = ['name', 'email', 'phone', 'message'];
// Pre-fill from cookies
$saved = loadFormCookies();
// Initial form data (cookies or empty)
$formData = [
'name' => $saved['name'],
'email' => $saved['email'],
'phone' => $saved['phone'],
'message' => '',
];
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
$formData = getPostData($fields);
$errors = validateContactForm($formData);
if (empty($errors)) {

if (hasCookieConsent()) {
saveFormCookies($formData);
}

$success = true;
$formData = ['name' => $saved['name'], 'email' => $saved['email'], 'phone' => $saved['phone']];
}
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontakto – Projekti Web</title>
<link rel ="stylesheet" href="../assets/css/style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+

</style>
</head>
<body>
<header class="page-header">
<p class="eyebrow">Na kontaktoni</p>
<h1>Dërgoni një <span>mesazh</span></h1>
<p>Plotësoni formularin dhe ne do t'ju kthejmë përgjigje sa më shpejt.</p>
</header>
<main class="card">
<?php if ($success): ?>
<div class="success-banner">
Mesazhi u dërgua me sukses! Do t'ju kontaktojmë së shpejti.
</div>
<?php endif; ?>
<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
<!-- Name -->
<div class="form-group">
<label for="name">Emri i plotë <span class="req">*</span></label>
<input
type="text"
id="name"
name="name"
value="<?= htmlspecialchars($formData['name']) ?>"
placeholder="p.sh. Artan Krasniqi"
class="<?= isset($errors['name']) ? 'error' : '' ?>"
autocomplete="name"
>
<?php if (isset($errors['name'])): ?>
<p class="error-msg"><?= htmlspecialchars($errors['name']) ?></p>
<?php endif; ?>
</div>
<!-- Email -->
<div class="form-group">
<label for="email">Adresa Email <span class="req">*</span></label>
<input
type="email"
id="email"
name="email"
value="<?= htmlspecialchars($formData['email']) ?>"
placeholder="p.sh. artan@email.com"
class="<?= isset($errors['email']) ? 'error' : '' ?>"
autocomplete="email"
>
<?php if (isset($errors['email'])): ?>
<p class="error-msg"><?= htmlspecialchars($errors['email']) ?></p>
<?php endif; ?>
</div>
<!-- Phone -->
<div class="form-group">
<label for="phone">Numri i telefonit <span class="req">*</span></label>
<input
type="tel"
id="phone"
name="phone"
value="<?= htmlspecialchars($formData['phone']) ?>"
placeholder="p.sh. +383 44 123 456"
class="<?= isset($errors['phone']) ? 'error' : '' ?>"
autocomplete="tel"
>
<?php if (isset($errors['phone'])): ?>
<p class="error-msg"><?= htmlspecialchars($errors['phone']) ?></p>
<?php endif; ?>
</div>
<!-- Message -->
<div class="form-group">
<label for="message">Mesazhi <span class="req">*</span></label>
<textarea
id="message"
name="message"
placeholder="Shkruani mesazhin tuaj këtu..."
class="<?= isset($errors['message']) ? 'error' : '' ?>"
><?= htmlspecialchars($formData['message']) ?></textarea>
<?php if (isset($errors['message'])): ?>
<p class="error-msg"><?= htmlspecialchars($errors['message']) ?></p>
<?php endif; ?>
</div>
<button type="submit" name="submit_contact" class="btn-submit">
DËRGONI MESAZHIN ->
</button>
</form>
<div class="info-strip">
<span class="info-chip"> RegEx email</span>
<span class="info-chip"> RegEx telefon</span>
<span class="info-chip"> Cookies aktive</span>
</div>
</main>
<!-- Cookie Consent Banner -->
<?php if (!hasCookieConsent()): ?>
<div class="cookie-banner" id="cookieBanner">
<p>
<strong>Ky faqe përdor cookies.</strong>
Ruajmë emrin, email-in dhe telefonin tuaj për t'i parapërgatitur formularët e ardhshë
</p>
<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<button type="submit" name="accept_cookies" class="btn-cookie">
Pranoj Cookies
</button>
</form>
</div>
<?php endif; ?>
</body>
</html>


<?php include "../includes/footer.php"; ?>

