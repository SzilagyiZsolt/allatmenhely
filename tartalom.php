<?php
switch ($menu) {
    case 'orokbefogadasUser':
        require_once './pages/orokbefogadasUser.php';
        break;
    case 'logout':
        require_once './pages/logout.php';
        break;
    case 'orokbefogadasGuest':
        require_once './pages/orokbefogadasGuest.php';
        break;
    case 'login':
        require_once './pages/login.php';
        break;
    case 'regisztracio':
        require_once './pages/regisztracio.php';
        break;
    case 'rolunk':
        require_once './pages/rolunk.php';
        break;
    default:
        require_once './pages/home.php';
        break;
}

