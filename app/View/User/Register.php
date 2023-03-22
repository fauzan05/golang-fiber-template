<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <a class="nav-link" aria-current="page" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control form-control-sm me-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-5 me-5">
                <?php
                if ($model['logout'] == null) {
                ?>
                    <li class="nav-item me-2 dropdown">
                        <a class="nav-link fa-solid fa-user" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/toko_online/public/users/login">Login</a></li>
                            <li><a class="dropdown-item" href="/toko_online/public/users/register">Register</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="alert alert-danger text-center" role="alert">
    A simple primary alert—check it out!
</div>
<form action="" method="post">
    <div class="container-fluid overflow-auto position-form-register mt-4 row">
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="username" name="username" class="form-control" id="exampleFormControlInput1" placeholder="username">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Firstname</label>
            <input type="firstname" name="firstname" class="form-control" id="exampleFormControlInput1" placeholder="firstname">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Lastname</label>
            <input type="lastname" name="lastname" class="form-control" id="exampleFormControlInput1" placeholder="lastname">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="email@example.com">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
            <input type="date" name="dateOfBirth" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3 col-6">
            <label for="gender" class="mb-2">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female">
                <label class="form-check-label" for="flexRadioDefault2">
                    Female
                </label>
            </div>
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
            <input type="phoneNumber" name="phoneNumber" class="form-control" id="exampleFormControlInput1" placeholder="08xxxxxxxxxxx">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Jobs</label>
            <input type="jobs" name="jobs" class="form-control" id="exampleFormControlInput1" placeholder="jobs">
        </div>
        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary position-button-register">Register</button>

</form>
<span class="fab fa-apple position-login-logo" style="letter-spacing: 0.5rem; font-size:5rem">REGISTER</span>