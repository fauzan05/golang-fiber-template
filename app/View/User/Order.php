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
  <a href="#" class="directory">Home/ Order</a>
  <br>
  <br>
  <hr>
  <div>
    <main class="grid-order">
      <article>
        <a href="#">
          <img class="img-order" src="http://localhost/toko_online/public/assets/images/iphoneX.png" alt="">
          <div class="order-detail">
            <h2>iPhone X</h2>
            <p>Order Date : 11-12-2022</p>
            <p>Status : Success</p>
          </div>
        </a>
      </article>
      <article>
        <a href="#">
          <img class="img-order" src="http://localhost/toko_online/public/assets/images/iphone6splus.png" alt="">
          <div class="order-detail">
            <h2>iPhone 6s Plus</h2>
            <p>Order Date : 11-12-2022</p>
            <p>Status : Success</p>
          </div>
        </a>
      </article>
    </main>
  </div>