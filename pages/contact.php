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
$saved = loadFormCookies();
$formData = [
    'name' => $saved['name'],
    'email' => $saved['email'],
    'phone' => $saved['phone'],
    'message' => '',
];

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

<?php include "../includes/header.php"; ?>

<div class="container-fluid p-0 mb-5" style="background-color: #ff6600 !important; color: white;">
    <div class="text-center" style="padding: 80px 0; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h1 class="display-4 fw-semibold">Contact Us</h1>
        <p class="lead mb-0">We'd love to hear from you</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <main class="card p-4 shadow-sm" style="border-radius: 15px;">
                <?php if ($success): ?>
                    <div class="alert alert-success text-center">Mesazhi u dërgua me sukses!</div>
                <?php endif; ?>

                <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Emri i plotë <span class="req">*</span></label>
                        <input type="text" id="name" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($formData['name']) ?>" placeholder="p.sh. Artan Krasniqi">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Adresa Email <span class="req">*</span></label>
                        <input type="email" id="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($formData['email']) ?>" placeholder="p.sh. artan@email.com">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone" class="form-label">Numri i telefonit <span class="req">*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($formData['phone']) ?>" placeholder="+383 44 123 456">
                    </div>

                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Mesazhi <span class="req">*</span></label>
                        <textarea id="message" name="message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>" rows="4" style="border-radius: 10px;" placeholder="Shkruani mesazhin tuaj këtu..."><?= htmlspecialchars($formData['message']) ?></textarea>
                    </div>

                    <button type="submit" name="submit_contact" class="btn btn-primary w-100 py-2 fw-bold">DËRGONI MESAZHIN -></button>
                </form>
            </main>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>

