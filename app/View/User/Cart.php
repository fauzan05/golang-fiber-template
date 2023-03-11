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
  <div>
    <main class="grid-order">
    <?php
            $cartsArray = $model['cartsArray'];
                foreach($cartsArray as $cartArray):
                
                    $product = $cartArray['product'];
                    $cart = $cartArray['cart'];
                ?>
      <article>
        <a href="#">
        <img class="img-order" src="http://localhost/toko_online/public/assets/images/products/<?= $product->image?>" alt="">
        <div class="order-detail">
          <h2><?= $product->name?></h2>
          <p>Color : <?= $product->color ?></p>
          <p>Price : <?= $product->price ?></p>
          <p>Quantity : <?= $cart->quantity ?></p>
          <p>Total : <?= $cart->quantity * $product->price ?></p>
          <p>Add To Cart Date : <?= $cart->createdAt ?></p>
        </div>
      </a>
      </article>
      <?php
                endforeach;
      ?>
  </main>
  </div>