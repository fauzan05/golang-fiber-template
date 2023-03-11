  <nav>
    <div class="logo">
      <h4>
        <p class="fab fa-apple"></p> iStore
      </h4>
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
  <a href="#" class="directory">Home/ Transaction</a>
  <br>
  <br>
  <hr>

  <img class="img-product-detail" src="http://localhost/toko_online/public/assets/images/iphoneX.png" alt="">
  <div class="container-transaction">
    <h1 class="fa fa-check-circle" style="font-size: 50px"></h1>
    <br>
    <br>
    <p>Buying iPhone X is Success! check transaction or back to homepage</p>
    <button class="backtohomepage"><a href="#" class="a">Back to Homepage</a></button>
  </div>