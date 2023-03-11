    <nav>
        <div class="logo">
            <h4><p class="fab fa-apple"></p> iStore</h4>
        </div>
    </nav>
    <br>
    <a href="#" class="directory">Home/ Login</a>
    <br>
    <br>
    <hr>
    <p class="alert-login"><?= $model['error'] ?? ''?></p>
    <div class="login-logo">
        <h4 class="fab fa-apple"> Login as Admin</h4>
    </div>
    <div class="login-form">
        <form method="post" action="/toko_online/public/admin/login">
            <input type="text" name="username" class="login-input" placeholder="Username" value="<?= $_POST['username'] ?? '' ?>"/>
            <input type="password" name="password" class="login-input" placeholder="Password"/>
            <br>
            <button class="login-button">Login</button>
        </form>
    </div>
