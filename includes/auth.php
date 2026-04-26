<?php
session_start();
require_once "users.php";

// LOGIN
function login($username, $password) {
    global $users;

    foreach ($users as $user) {
        if ($user["username"] === $username && $user["password"] === $password) {

            $_SESSION["user"] = [
                "username" => $user["username"],
                "role" => $user["role"]
            ];

            // cookie për personalizim (bonus)
            setcookie("username", $user["username"], time() + 3600);

            return true;
        }
    }
    return false;
}

// CHECK LOGIN
function isLoggedIn() {
    return isset($_SESSION["user"]);
}

// GET USER
function getUser() {
    return $_SESSION["user"] ?? null;
}

// GET ROLE
function getRole() {
    return $_SESSION["user"]["role"] ?? null;
}

// LOGOUT
function logout() {
    session_unset();
    session_destroy();
}

// PROTECT PAGE
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

// ROLE CONTROL
function requireRole($role) {
    if (!isLoggedIn() || getRole() !== $role) {
        echo "<h3>Access denied!</h3>";
        exit();
    }
}