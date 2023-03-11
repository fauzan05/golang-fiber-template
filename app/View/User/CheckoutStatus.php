<nav>
    <div class="logo">
    <a href="/toko_online/public/" class="fab fa-apple a"> <?= $model['logo'] ?? '' ?></a>
    </div>
    <ul class="nav-menu">
    <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPhone';?>">iPhone</a></li>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPad';?>">iPad</a></li>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Mac';?>">Mac</a></li>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Watch';?>">Watch</a></li>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/listProduct?category=<?= $category = 'Tv';?>">Tv</a></li>
      <li class="nav-item"><a class="nav-link" href="#">About</a></li>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/cart?category=<?= $category = 'Cart';?>">Cart</a></li>
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
  <a href="#" class="directory">Home/ Cart</a>
  <br>
  <br>
  <hr>

  <h1>Checkout Sukses!!!</h1>