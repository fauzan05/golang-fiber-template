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
  <a href="#" class="directory">Home/ Checkout</a>
  <br>
  <br>
  <hr>
  <p><?= $model['error'] ?? ''?></p>
  <img class="img-product-detail" src="http://localhost/toko_online/public/assets/images/products/<?= $model['productImage']?>" alt="">
  <div class="container-product">
    <form action="/toko_online/public/users/productDetail" method="post">
      <input type="text" name="id" value="<?= $model['productId']?>" style="display:none">
      <h2><?= $model['productName'] ?></h2>
      <br>
      <?php
      if ($model['productStock'] > 0) {
      ?>
        <p class="fa fa-check"></p> Stock Available</p>
      <?php
      }
      ?>
      <br>
      <h4>Color :</h4>
      <br>
      <select id="color">
        <option value="<?= $model['productColor'] ?? ''?>"><?= $model['productColor'] ?? ''?></option>
      </select>
      <br>
      <br>
      <h4>Capacity :</h4>
      <br>
      <select id="capacity">
        <option value="<?= $model['productCapacity'] ?? ''?>"><?= $model['productCapacity'] ?? ''?></option>
      </select>
      <br>
      <br>
      <h4>Price :</h4>
      <br>
      <input type="text" name="price" value="<?= $model['productPrice'] ?? ''?>">
      <br>
      <h4>Quantity :</h4>
      <br>
      <select name="quantity" id="quantity">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <br>
      <br>
      <button name="addToCart" value="true" class="addtocart-button">
        <p class="fa fa-cart-plus"></p> Add to Cart
      </button>
      <button name="buyNow" value="true" class="buynow-button">Buy Now !</button>
    </form>

  </div>