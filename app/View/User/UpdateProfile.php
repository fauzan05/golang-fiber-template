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
        <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/profile"><?= $model['user'] ?? '' ?></a></li>
        <li class="nav-item"><a href="/toko_online/public/users/logout" class="nav-link">Logout</a></li>
    </ul>
    <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</nav>
<br>
<a href="#" class="directory">Home/ profile</a>
<br>
<br>
<hr>
<p> <?= $model['error'] ?? '' ?></p>
<form action="/toko_online/public/users/updateProfile" method="post">
    <div class="form-edit-product1">
        <div class="input-group">
            <label for="id" class="register-label">Id</label>
            <input type="text" name="id" class="register-input" placeholder="id" id="id" disabled value="<?= $model['id'] ?? '' ?> " />
        </div>
        <div class="input-group">
            <label for="username" class="register-label">Username</label>
            <input type="text" name="username" class="register-input" placeholder="username" id="username" readonly value="<?= $model['username'] ?? '' ?> " />
        </div>
        <div class="input-group">
            <label for="firstname" class="register-label">Firstname</label>
            <input type="text" name="firstname" class="register-input" placeholder="firstname" id="firstname" value="<?= $model['firstname'] ?? '' ?>" />
        </div>
        <div class="input-group">
            <label for="lastname" class="register-label">Lastname</label>
            <input type="text" name="lastname" class="register-input" placeholder="lastname" id="lastname" value="<?= $model['lastname'] ?? '' ?>" />
        </div>
        <div class="input-group">
            <label for="email" class="register-label">Email</label>
            <input type="text" name="email" class="register-input" placeholder="email" id="email" value="<?= $model['email'] ?? '' ?>" />
        </div>
        <div class="input-group">
            <label for="gender" class="register-label">Gender</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <button class="edit-profile-button"><a class="a">Save</a></button>
    </div>
    <div class="form-edit-product2">
        <div class="input-group">
            <label for="phoneNumber" class="register-label">Phone Number</label>
            <input type="text" name="phoneNumber" class="register-input" placeholder="phoneNumber" value="<?= $model['phoneNumber'] ?? '' ?>" />
        </div>
        <div class="input-group">
            <label for="jobs" class="register-label">Jobs</label>
            <input type="text" name="jobs" class="register-input" placeholder="jobs" value="<?= $model['jobs'] ?? '' ?>" />
        </div>
        <div class="input-group">
            <label for="dateOfBirth" class="register-label">Date of Birth</label>
            <input type="date" name="dateOfBirth" class="register-input" placeholder="date of birth" />
        </div>
        <div class="input-group">
            <label class="register-label">Address</label>
            <textarea id="description" type="text" name="address" class="register-input-textarea" />
            <?= $model['address'] ?? '' ?>
            </textarea>
        </div>
        <div class="input-group">
            <label for="status" class="register-label">Status</label>
            <input type="text" name="status" class="register-input" placeholder="status" id="status" disabled value="<?= $model['status'] ?? '' ?> " />
        </div>
    </div>
</form>