<?php declare(strict_types=1);
// Redirect to login if not logged in, otherwise to dashboard
require_once 'config/session.php';

if (isLoggedIn()) {
    header('Location: views/dashboard.php');
} else {
    header('Location: views/auth/login.php');
}
exit();
?>
