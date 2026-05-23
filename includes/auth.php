<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "database.php";
/*
    LOGIN FUNCTION (DB + SECURITY)
*/
function login($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows === 1) {

        $stmt->bind_result($id, $name, $emailDB, $passwordDB, $role);
        $stmt->fetch();

        if (password_verify($password, $passwordDB)) {

            session_regenerate_id(true);

            $_SESSION["user"] = [
                "id" => $id,
                "name" => htmlspecialchars($name),
                "email" => htmlspecialchars($emailDB),
                "role" => $role
            ];

            return true;
        }
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