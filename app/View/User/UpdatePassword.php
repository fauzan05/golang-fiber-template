<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
                    <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart"></a>
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
                        <li><a class="dropdown-item" href="/toko_online/public/users/dashboard">Profile</a></li>
                        <li><a class="dropdown-item" href="/toko_online/public/users/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
if ($model['error'] != null) :
?>
    <div class="alert alert-danger text-center" role="alert">
        <?= $model['error'] ?? null ?>
    </div>
<?php
endif;
?>
<div class="row">
    <div class="container-fluid col-7 my-4" style="border: 1px solid #dee2e6; height:auto; position:absolute; right:10%">
        <h1 class="m-3">Update Password</h1>
        <hr>
        <form action="/toko_online/public/users/updatePassword" method="post">
            <div class="row" style="justify-content:center;">
                <input type="text" name="username" value="<?= $model['username'] ?>" hidden>
                <div class="mb-3 col-5">
                    <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                    <input type="password" name="oldPassword" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3 col-5">
                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                    <input type="password" name="newPassword" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="row" style="justify-content:center;">
                <button type="submit" class="btn btn-primary m-4 col-lg-8">Update</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="container-fluid col-2 my-4" style=" height:auto; position:absolute; left:5%">
        <div class="row">
            <a class="col-12 mt-3" href="http://localhost/toko_online/public/users/dashboard" style="text-decoration: none; color:black;">Dashboard</a>
            <hr>
            <a class="col-12" href="/toko_online/public/users/updateProfile" style="text-decoration: none; color:black;">Account Information</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Orders History</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Track Orders</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Favourite</a>
            <hr>
            <a class="col-12 fw-bolder" href="http://localhost/toko_online/public/users/updatePassword" style="text-decoration: none; color:black;">Update Password</a>
            <hr>
        </div>

    </div>
</div>