<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
          <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
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
<div class="containerrr">
  <div class="row">
    <div class="container-fluid col-7 my-4" style="border: 1px solid #dee2e6; height:auto; position:absolute; right:10%">
      <h1 class="m-3">Total : <?= $model['countAllTransaction'] ?> Transaction</h1>
      <hr>
      <div class="overflow-auto" style="height: 480px;">
        <?php
        $allOrder = $model['showAllOrder'];
        if ($allOrder == null) {
          ?>
          <div style="justify-content: center; align-items:center; display:flex;">
          <p class="fw-light">Your order has empty</p>
          </div>
          <?php
        }
        foreach ($allOrder as $order) :
        ?>
          <div class="row m-4 grid gap-0 row-gap-3 shadoww">
            <div class="col-lg-12" style="border: 1px solid #dee2e6; height:20vh">
              <div class="row m-1">
                <div class="col-lg-3" style="align-items:center; display:flex; justify-content:center;">
                  <img src="http://localhost/toko_online/public/assets/images/products/<?= $order->image ?>" alt="product-image" style="width:100px; height:100px; object-fit:contain;">
                </div>
                <div class="col-lg-3 m-1">
                  <h2 class="fw-light"><?= $order->name ?></h2>
                  <p><?= $order->total ?> Item x <?= $order->price ?> IDR</p>
                  <p>Total : <?= $order->amount ?> </p>
                </div>
                <div class="col-lg-5 m-1">
                  <p>Shopping Date : <?= $order->created_at_order ?></p>
                  <button type="button" class="btn btn-outline-success" disabled><?= $order->status ?></button>
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
</div>
<div class="containerrr">
  <div class="row">
    <div class="container-fluid col-2 my-4" style=" height:auto; position:absolute; left:5%">
      <div class="row">
        <a class="col-12 mt-3" href="/toko_online/public/users/dashboard" style="text-decoration: none; color:black;">Dashboard</a>
        <hr>
        <a class="col-12" href="/toko_online/public/users/updateProfile" style="text-decoration: none; color:black;">Account Information</a>
        <hr>
        <a class="col-12 fw-bolder" href="/toko_online/public/users/orderHistory" style="text-decoration: none; color:black;">Orders History</a>
        <hr>
        <a class="col-12 " href="" style="text-decoration: none; color:black;">Track Orders</a>
        <hr>
        <a class="col-12 " href="" style="text-decoration: none; color:black;">Favourite</a>
        <hr>
      </div>
    </div>
  </div>
</div>