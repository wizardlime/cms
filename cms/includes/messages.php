<?php
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success mt-3">' . htmlentities($_SESSION['message']) . '</div>';
    unset($_SESSION['message']);
}

if (!empty($_SESSION['error'])) {
    echo '<div class="alert alert-danger mt-3">' . htmlentities($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
?>