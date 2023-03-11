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
<div class="detail-profile-user">
  <div class="container-detail-profile-user">
    <h5>Id : <?= $model['id'] ?></h5>
    <h5>Username : <?= $model['username'] ?></h5>
    <h5>Firstname : <?= $model['firstname'] ?></h5>
    <h5>Lastname : <?= $model['lastname'] ?></h5>
    <h5>Email : <?= $model['email'] ?></h5>
    <h5>Gender : <?= $model['gender'] ?></h5>
    <h5>Phone Number : <?= $model['phoneNumber'] ?></h5>
    <h5>Address : <?= $model['address'] ?></h5>
    <h5>Jobs : <?= $model['jobs'] ?></h5>
    <h5>Date of Birth : <?= $model['dateOfBirth'] ?></h5>
    <h5>Status : <?= $model['status'] ?></h5>
    <h5>Joined At : <?= $model['createdAt'] ?></h5>
    <br>
    <br>
    <button class="edit-user"><a href="/toko_online/public/users/updateProfile" class="a">Edit Profile</a></button>
  </div>
</div>