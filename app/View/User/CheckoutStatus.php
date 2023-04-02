<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbarrr">
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
          <a class="nav-link" aria-current="page" href="/toko_online/public/users/about">About</a>
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
        <li class="nav-item me-2 dropdown">
          <a class="nav-link fa-solid fa-user" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false"></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/toko_online/public/users/dashboard">Profile</a></li>
            <li><a class="dropdown-item" href="/toko_online/public/users/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid containerrr">
  <div class="row m-4" style="border: 1px solid #dee2e6; height:auto;">
    <div class="col-lg-12">
      <h1 class="fw-light text-center col-lg-12 m-4">Your Checkout has been successfully</h1>
      <hr>
      <h4 class="fw-light text-center col-lg-12 m-4">Details Item</h4>
      <?php
      foreach ($model['showLatestOrder'] as $order) :
      ?>
        <div class="row" style="justify-content: center;">
          <div class="col-lg-6 mb-5">
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-success text-center ms-0" role="alert">
                  <?= $order->status ?>
                </div>
              </div>
              <div class="col-lg-3 mt-5">
                <img src="http://localhost/toko_online/public/assets/images/products/<?= $order->image ?>" alt="product-image" style="width:100px; height:100px; object-fit:contain;">
              </div>
              <div class="col-lg-3">
                <p class="fw-light"> Product Name : <?= $order->productName?> </p>
                <p class="fw-light"> Price : <?= $order->price?> IDR</p>
                <p class="fw-light"> Quantity : <?= $order->total?> Qty</p>
                <p class="fw-light"> Total : <?= $order->amount?> IDR</p>
              </div>
              <div class="col-lg-6">
                <p class="fw-light"> Payment Date : <?= $order->created_at_payment?></p>
                <p class="fw-light"> Category : <?= $order->category?></p>
              </div>
              <div class="col-lg-12">
                <div class="alert alert-success text-center ms-0" role="alert">
                  <p>Order Id : <?= $order->orderId ?></p>
                </div>
              </div>
              <div class="text-center">
                <a href="/toko_online/public/users/orderHistory">Check Your All Order History</a>
              </div>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>
</div>