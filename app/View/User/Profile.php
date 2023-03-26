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
          <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
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
<div class="row">
  <div class="container-fluid col-7 my-4" style="border: 1px solid grey; height:auto; position:absolute; right:10%">
    <h1 class="m-3">Welcome, <?= $model['username'] ?></h1>
    <hr>
    <div class="row text-center">
      <h4 class="col-12 fw-light">Balance</h4>
      <h4 class="fw-bolder"><?= $model['balance'] ?> IDR</h4>
    </div>
    <hr>
    <div class="row gap-0 row-gap-5 mb-5">
      <div class="container-fluid col-5 text-center" style="border: 1px solid grey; height:150px;">
        <p class="fw-light mt-2">Order</p>
        <hr>
      </div>
      <div class="container-fluid col-5 text-center" style="border: 1px solid grey; height:150px;">
        <p class="fw-light mt-2">Product Review</p>
        <hr>
      </div>
      <div class="container-fluid col-5 text-center" style="border: 1px solid grey; height:150px;">
        <p class="fw-light mt-2">Address</p>
        <hr>
      </div>
      <div class="container-fluid col-5 text-center" style="border: 1px solid grey; height:150px;">
        <p class="fw-light mt-2">Point</p>
        <hr>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="container-fluid col-2 my-4" style=" height:auto; position:absolute; left:5%">
    <div class="row">
      <a class="col-12 mt-3 fw-bolder" href="http://localhost/toko_online/public/users/profile" style="text-decoration: none; color:black;">Dashboard</a>
      <hr>
      <a class="col-12" href="/toko_online/public/users/updateProfile" style="text-decoration: none; color:black;">Account Information</a>
      <hr>
      <a class="col-12 " href="/toko_online/public/users/orderHistory" style="text-decoration: none; color:black;">Orders History</a>
      <hr>
      <a class="col-12 " href="" style="text-decoration: none; color:black;">Track Orders</a>
      <hr>
      <a class="col-12 " href="" style="text-decoration: none; color:black;">Favourite</a>
      <hr>
    </div>

  </div>
</div>