<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}
?>

<nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"> Y<span class="text-warning">OUN</span>G✨<span class="text-warning">S</span>TAR<span class="text-warning">S✨F</span>C</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Entertainment</a></li>
                        <li><a class="dropdown-item" href="#">Health</a></li>
                        <li><a class="dropdown-item" href="#">Sport</a></li>
                        <li><a class="dropdown-item" href="#">Technology</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Staff
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=create_post">Add Post</a></li>
                        <li><a class="dropdown-item" href="#">Role Management</a></li>
                    </ul>
                </li>
                <li class="nav-item logout">
                    <button class="btn btn-outline-light my-2" type="submit">Logout</button>
                </li>
            </ul>
            <form class="d-flex align-items-center" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
                <img src="./assets/images/profile.jpg" alt="profile-img" class="profile-pic ">
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