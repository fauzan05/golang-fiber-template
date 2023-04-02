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
        }
        ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid containerrr">
  <div class="container">
    <h2 class="text-center py-5">Our Products</h2>
    <div class="row gap-0 row-gap-4">
      <?php
      $no = 1;
      if (isset($model['showAllProduct'])) {
        $products = $model['showAllProduct'];
        foreach ($products as $product) :
      ?>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <a href="/toko_online/public/users/productDetail?id=<?= $product->id; ?>" style="text-decoration: none; color:black;">
              <div class="shadoww" style="border: 1px solid #dee2e6;">
                <div class="row m-1">
                  <div class="col-lg-12" style="display: flex; align-items:center; justify-content:center;">
                    <img src="http://localhost/toko_online/public/assets/images/products/<?= $product->image ?>" class="card-img-top col-md-6 mx-auto mt-4" alt="product" style="width:150px; height:150px; object-fit:contain;"">
                  </div>
                  <div class=" card-body">
                    <h5 class="card-title text-center"><?= $product->name ?></h5>
                    <h6 class="text-center"><?= $product->price ?> IDR</h6>
                  </div>
                </div>
              </div>
            </a>
          </div>

      <?php
          $no++;
        endforeach;
      }
      ?>
    </div>
  </div>
</div>