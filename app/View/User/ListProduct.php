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
      <?php 
      if($model['logout'] != null){
      ?>
      <li class="nav-item"><a class="nav-link" href="/toko_online/public/users/profile"><?= $model['user'] ?? '' ?></a></li>
      <?php
      }
      ?>
      <li class="nav-item"><a href="/toko_online/public/users/<?= $model['logout'] ?? $model['login'] ?>" class="nav-link"><?= $model['logoutButton'] ?? $model['loginButton'] ?></a></li>
    </ul>
    <div class="hamburger">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </nav>
  <br>
  <a href="#" class="directory">Home/</a>
  <br>
  <br>
  <hr>
  <main class="grid">
  <?php
                $no = 1;
                if (isset($model['showAllProduct'])) {
                    $products = $model['showAllProduct'];
                    foreach ($products as $product) :
                ?>
      <article>
      <a href="/toko_online/public/users/productDetail?id=<?= $product->id?>">
        <img src="http://localhost/toko_online/public/assets/images/products/<?= $product->image ?>" alt="">
        <div class="content">
          <h2><?= $product->name?></h2>
          <p><?= $product->price?> IDR</p>
        </div>
      </a>
      </article>
            
               
                <?php
                  $no++;
                    endforeach;
                }
                ?>
    </main>