<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php">All</a></li>
                        <li><a class="dropdown-item" href="?category=updates">Updates</a></li>
                        <li><a class="dropdown-item" href="?category=tournament">Tournament</a></li>
                        <li><a class="dropdown-item" href="?category=fun">Fun</a></li>
                        <li><a class="dropdown-item" href="?category=others">Others</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <button type="button" class="btn btn-outline-light"><a href="?page=register" class="text-dark text-decoration-none">Register</a></button>
                <button type="button" class="btn btn-outline-light mx-2"><a href="?page=login" class="text-dark text-decoration-none">Login</a></button>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
</style>