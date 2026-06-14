<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "database.php";
/*
    LOGIN FUNCTION (DB + SECURITY)
*/
function login($email, $password) {
    global $conn; // $conn duhet të jetë objekti PDO

    // Përdorim sintaksën PDO për të përgatitur query-n
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kontrollojmë nëse përdoruesi ekziston dhe passwordi është korrekt
    if ($user && password_verify($password, $user['password'])) {
        
        session_regenerate_id(true);

        $_SESSION["user"] = [
            "id" => $user['id'],
            "name" => htmlspecialchars($user['name']),
            "email" => htmlspecialchars($user['email']),
            "role" => $user['role']
        ];

        return true;
    }

    return false;
}
/*
    CHECK IF LOGGED IN
*/
function isLoggedIn() {
    return isset($_SESSION["user"]);
}

/*
    GET USER DATA
*/
function getUser() {
    return $_SESSION["user"] ?? null;
}

/*
    GET ROLE
*/
function getRole() {
    return $_SESSION["user"]["role"] ?? null;
}

/*
    LOGOUT
*/
function logout() {
    $_SESSION = [];
    session_unset();
    session_destroy();
}


/*
    PROTECT PAGE (LOGIN REQUIRED)
*/
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /project/pages/login.php");
        exit();
    }
}

function requireRole(array $roles) {
    if (!isLoggedIn()) {
        header("Location: /project/pages/login.php");
        exit();
    }

    if (!in_array(getRole(), $roles)) {
        header("Location: /project/pages/dashboard.php");
        exit();
    }
}
?>