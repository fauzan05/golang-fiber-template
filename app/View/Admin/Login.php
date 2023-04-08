<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbarrr">
    <div class="container-fluid m-3">
        <a class="navbar-brand fab fa-apple ms-3 me-5" href="/toko_online/public/" style="letter-spacing: 0.2rem;"><?= $model['logo'] ?? '' ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto gap-5">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPhone'; ?>">iPhone</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPad'; ?>">iPad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Mac'; ?>">Mac</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Watch'; ?>">Watch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Tv'; ?>">Tv</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control form-control-sm me-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-5 me-5">
                <li class="nav-item me-2 dropdown">
                    <a class="nav-link fa-solid fa-user" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/toko_online/public/users/login">Login</a></li>
                        <li><a class="dropdown-item" href="/toko_online/public/users/register">Register</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="alerttt">
    <?php
    if ($model['error']) {
    ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $model['error'] ?? null ?>
        </div>
    <?php
    }
    ?>
</div>
<div class="containerrr">
    <div class="row" style="justify-content: center; align-items:center; height:100vh;">
        <div class="container-fluid col-lg-4 text-center">
                <span class="fab fa-apple position-login-logo" style="letter-spacing: 0.3rem; font-size:2rem">Login as Admin</span>
                <div class="col-lg-12 text-center mt-5">
                </div>
        </div>
        <div class="container-fluid col-lg-4">
            <form role="form" method="POST" action="/toko_online/public/admin/login">
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="username" style="width: 350px" value="<?= $_POST['username'] ?? '' ?>">
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password" style="width: 350px">
                </div>
                <button type="submit" class="btn btn-primary mt-3" style="width: 350px">Login</button>
            </form>
        </div>
    </div>
</div>