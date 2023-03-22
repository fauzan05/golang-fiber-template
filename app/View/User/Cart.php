<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid m-3">
    <a class="navbar-brand fab fa-apple ms-3 me-5" href="/toko_online/public/" style="letter-spacing: 0.2rem;"><?= $model['logo'] ?? '' ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto gap-5">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPhone'; ?>">iPhone</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'iPad'; ?>">iPad</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Mac'; ?>">Mac</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Watch'; ?>">Watch</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/listProduct?category=<?= $category = 'Tv'; ?>">Tv</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart"></a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control form-control-sm me-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ms-5 me-5">
        <?php
        if ($model['userExist'] == null) {
        ?>
          <li class="nav-item me-2 dropdown">
            <a class="nav-link fa-solid fa-user" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/toko_online/public/users/login">Login</a></li>
              <li><a class="dropdown-item" href="/toko_online/public/users/register">Register</a></li>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item me-2 dropdown">
            <a class="nav-link fa-solid fa-user" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/toko_online/public/users/dashboard">Profile</a></li>
              <li><a class="dropdown-item" href="/toko_online/public/users/logout">Logout</a></li>
            </ul>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<h2 class="text-center py-5">Your Cart</h2>
<div class="row mb-5" style="display:flex; justify-content:center;">
  <?php
  $cartsArray = $model['cartsArray'];
  foreach ($cartsArray as $cartArray) :
    $product = $cartArray['product'];
    $cart = $cartArray['cart'];
  ?>
    <div class="container-fluid col-lg-6 col-md-6 m-3" style="border: 1px solid grey;height: 200px;">
      <div class="row">
        <img src="http://localhost/toko_online/public/assets/images/products/<?= $product->image ?>" class="col-lg-3 col-md-3 mt-5 ms-3" alt="product-image" style="height: 120px;">
        <div class="container-fluid col-lg-3 col-md-3 m-4">
          <h2 class=""><?= $product->name ?></h2>
          <p class="">Price : <?= $product->price ?></p>
          <p class="">Quantity : <?= $cart->quantity ?></p>
          <p class="">Shopping Id : <?= $cart->sessionId ?></p>
        </div>
        <div class="container-fluid col-lg-2 col-md-2 m-4">
        <a href="/toko_online/public/users/deleteCart?id=<?= $cart->sessionId; ?>"><button type="submit" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-session-id=<?= $cart->sessionId?>>Delete</button></a>
        <a href="/toko_online/public/users/productDetail?id=<?= $product->id; ?>" style="text-decoration: none;"><button type="button" class="btn btn-primary m-2">Checkout</button></a>
        </div>
      </div>
    </div>
  <?php
  endforeach;
  if($cartsArray == null){
    echo "Your cart has empty";
  }
  ?>
</div>


