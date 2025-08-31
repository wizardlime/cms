<?php
include __DIR__ . '/header.php';

$page = $_GET['page'] ?? 'dashboard';

switch($page) {
    case 'reservations':
        include __DIR__ . '/reservations/reservations_overview.php';
        break;

    case 'rooms':
        include __DIR__ . '/rooms/rooms_overview.php';
        break;

    case 'users':
        include __DIR__ . '/users/users_overview.php';
        break;

    case 'dashboard':
    default:
        include __DIR__ . '/dashboard.php';
        break;
}

