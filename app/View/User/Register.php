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
    <div class="register-logo">
        <h4 class="fab fa-apple"> Register</h4>
    </div>
    <form action="/toko_online/public/users/register" method="post">
        <div class="form-register1">
            <div class="input-group">
                <label for="username" class="register-label">Username</label>
                <input type="text" name="username" class="register-input" placeholder="username" id="username" value="<?= $_POST['username'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label for="firstname" class="register-label">Firstname</label>
                <input type="text" name="firstname" class="register-input" placeholder="firstname" id="firstname" value="<?= $_POST['firstname'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label for="lastname" class="register-label">Lastname</label>
                <input type="text" name="lastname" class="register-input" placeholder="lastname" value="<?= $_POST['lastname'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label for="email" class="register-label">E-mail</label>
                <input type="text" name="email" class="register-input" placeholder="email" value="<?= $_POST['email'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label for="password" class="register-label">Password</label>
                <input type="password" name="password" class="register-input" placeholder="password" />
            </div>
            <div class="input-group">
                <label for="dateOfBirth" class="register-label">Date of Birth</label>
                <input type="date" name="dateOfBirth" class="register-input" placeholder="date of birth" value="<?= $_POST['dateOfBirth'] ?? '' ?>" />
            </div>
            <button class="register-button">Register</button>
        </div>
        <div class="form-register2">
            <div class="input-group">
                <label for="gender" class="register-label">Gender</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="input-group">
                <label for="phoneNumber" class="register-label">Phone Number</label>
                <input type="text" name="phoneNumber" class="register-input" placeholder="phonenumber" id="phoneNumber" value="<?= $_POST['phoneNumber'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label for="jobs" class="register-label">Jobs</label>
                <input type="text" name="jobs" class="register-input" placeholder="jobs" id="jobs" value="<?= $_POST['jobs'] ?? '' ?>" />
            </div>
            <div class="input-group">
                <label class="register-label">Address</label>
                <textarea id="address" type="text" name="address" class="register-input-textarea">
                </textarea>
            </div>
        </div>
    </form>

    <div class="login-link">
        <p>Have any account?</p>
    </div>
    <a href="/toko_online/public/users/login" class="login-link-redirect"> Login!</a>