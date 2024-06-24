<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}

// Get current page
function getCurrentPage()
{
    return basename($_SERVER['PHP_SELF'], ".php");
}

function isActive($page, $currentPage, $queryParam = '', $queryValue = '')
{
    if ($queryParam && isset($_GET[$queryParam])) {
        return $_GET[$queryParam] === $queryValue ? 'active' : '';
    }
    if (!$queryParam && !isset($_GET['page']) && !isset($_GET['category'])) {
        return $page === $currentPage ? 'active' : '';
    }
    return '';
}

$current_page = getCurrentPage();
$category_page = isset($_GET['category']) ? $_GET['category'] : '';
$page_query = isset($_GET['page']) ? $_GET['page'] : '';
?>

<nav class="navbar navbar-expand-lg bg-warning" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"> Yyy<span class="text-primary">OUN</span>G✨<span class="text-primary">S</span>TAR<span class="text-primary">S✨F</span>C</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= isActive('index', $current_page) ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= $category_page ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $category_page === '' ? 'active' : '' ?>" href="index.php">All</a></li>
                        <li><a class="dropdown-item <?= $category_page === 'updates' ? 'active' : '' ?>" href="?category=updates">Updates</a></li>
                        <li><a class="dropdown-item <?= $category_page === 'tournament' ? 'active' : '' ?>" href="?category=tournament">Tournament</a></li>
                        <li><a class="dropdown-item <?= $category_page === 'fun' ? 'active' : '' ?>" href="?category=fun">Fun</a></li>
                        <li><a class="dropdown-item <?= $category_page === 'others' ? 'active' : '' ?>" href="?category=others">Others</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" action="index.php" method="GET">
                <button type="button" class="btn btn-outline-light"><a href="?page=register" class="text-dark text-decoration-none">Register</a></button>
                <button type="button" class="btn btn-outline-light mx-2"><a href="?page=login" class="text-dark text-decoration-none">Login</a></button>
                <input class="form-control me-2" type="search" name="search" placeholder="Search" maxlength="15" aria-label="Search" required>
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<style>
    .profile-pic {
        height: 38px;
        width: 38px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 5px;
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link.show {
        color: black !important;
        font-weight: bold !important;
    }

    .nav-link {
        color: gray !important;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important;
    }
</style>