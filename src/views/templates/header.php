<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}

include_once 'db.php';
$userController = new UserController($pdo);
$user_details = $userController->view_user_profile();

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .profile-pic {
            height: 38px;
            width: 38px;
            object-fit: cover;
            border-radius: 50%;
            margin-left: 5px;
            cursor: pointer;
            display: none !important;
        }

        .logout-svg {
            display: none;
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

        @media (min-width: 1024px) {
            .profile-pic {
                margin-left: 20px;
                margin-right: 20px;
                display: block !important;
            }

            .logout-svg {
                display: block;
                cursor: pointer;
            }

            .logout {
                display: none;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-warning fixed-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"> Y<span class="text-primary">OUN</span>G✨<span class="text-primary">S</span>TAR<span class="text-primary">S✨F</span>C</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('index', $current_page) ?>" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('profile', $page_query, 'page', 'profile') ?>" href="?page=profile">Profile</a>
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
                    <?php if ($user_details['privilege'] == 'admin' || $user_details['privilege'] == 'editor') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= isActive('create_post', $page_query, 'page', 'create_post') ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Staff
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item <?= isActive('create_post', $page_query, 'page', 'create_post') ?>" href="?page=create_post">Add Post</a></li>
                                <?php if ($user_details['privilege'] == 'admin') : ?>
                                    <li><a class="dropdown-item <?= isActive('all_users', $page_query, 'page', 'all_users') ?>" href="?page=all_users">Role Management</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item logout">
                        <button class="btn btn-outline-light my-2" type="submit">Logout</button>
                    </li>
                </ul>
                <form class="d-flex align-items-center" role="search" action="index.php" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" maxlength="15" aria-label="Search" required>
                    <button class="btn btn-outline-light" type="submit">Search</button>
                    <a href="?page=profile"><img src="<?= htmlspecialchars($user_details['avatar']) ?>" alt="profile-img" class="profile-pic"></a>
                    <a href="?page=logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="logout-svg bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>