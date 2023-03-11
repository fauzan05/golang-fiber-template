    <nav>
        <div class="logo">
            <a href="/toko_online/public/" class="fab fa-apple a"> <?= $model['logo'] ?? '' ?></a>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPhone'; ?>">iPhone</a></li>
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPad'; ?>">iPad</a></li>
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Mac'; ?>">Mac</a></li>
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Watch'; ?>">Watch</a></li>
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Tv'; ?>">Tv</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>">Cart</a></li>
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <br>
    <a href="#" class="directory">Home/ Login</a>
    <br>
    <br>
    <hr>
    <p class="alert-login"><?= $model['error'] ?? '' ?></p>
    <div class="login-logo">
        <h4 class="fab fa-apple"> Login</h4>
    </div>
    <div class="login-form">
        <form method="post" action="/toko_online/public/users/login">
            <input type="text" name="email" class="login-input" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>" />
            <input type="password" name="password" class="login-input" placeholder="Password" />
            <br>
            <button class="login-button">Login</button>
        </form>
    </div>
    <div class="register-link">
        <p>Dont have any account?</p>
    </div>
    <a href="/toko_online/public/users/register" class="register-link-redirect">Create account!</a>