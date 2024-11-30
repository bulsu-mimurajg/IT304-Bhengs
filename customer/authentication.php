<?php
if (isset($_SESSION['loggedIn'])) {
} else {
    redirect('../login.php', 'Login to continue...');
}
