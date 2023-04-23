<div class="row no-gutters fixed-top">
  <div class="col-lg-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid m-3">
        <a class="navbar-brand fab fa-apple ms-3 me-5" href="/toko_online/public/" style="letter-spacing: 0.2rem;"><?= $model['logo'] ?? '' ?> | ADMIN</a>
        <div class="d-flex flex-row">
          <form class="d-flex" role="search">
            <input class="form-control form-control-sm me-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
          <a class="fa fa-envelope nav-link ms-5 me-3 mt-2" data-bs-toggle="tooltip" title="Message" href="#"></a>
          <a class="fa fa-right-from-bracket nav-link ms-5 me-5 mt-2" data-bs-toggle="tooltip" title="Logout" href="/toko_online/public/admin/logout"></a>
        </div>
      </div>
    </nav>
  </div>
  <div class="col-lg-2 pt-5 bg-dark" style="z-index: -1; height:100vh;">
    <ul class="nav flex-column pt-3 mb-5 grid gap-0 row-gap-5 ms-5">
      <li class="nav-item my-3">
        <a class="nav-link active text-white" aria-current="page" href="/toko_online/public/">Dashboard</a>
      </li>
      <li class="nav-item my-3">
        <a class="nav-link active text-white" aria-current="page" href="/toko_online/public/admin/productManagement">Products</a>
      </li>
      <li class="nav-item my-3">
        <a class="nav-link active text-white" aria-current="page" href="/toko_online/public/admin/userManagement">Users</a>
      </li>
      <li class="nav-item my-3">
        <a class="nav-link active text-white" aria-current="page" href="/toko_online/public/admin/about">About</a>
      </li>
      <li class="nav-item my-3">
        <a class="nav-link active text-white" aria-current="page" href="/toko_online/public/admin/profile">Settings</a>
      </li>
    </ul>
  </div>
  <div class="col-lg-10">
    <h3 class="mt-3 ms-3">Detail Product</h3>
    <hr>
    <a href="/toko_online/public/admin/productManagement" class="fa fa-arrow-left" style="text-decoration: none; color:black; letter-spacing:0.2rem"> Back</a>
    <div class="row mt-4 md-4 mx-5">
      <div class="col-lg-12" style="border: 1px solid #dee2e6; height:auto;">
        <div class="row gap-5" style="justify-content: center; display:flex; align-items:center; height:auto;">
          <div class="col-lg-5 mt-5" style="justify-content: center; display:flex; align-items:center;">
            <img src="http://localhost/toko_online/public/assets/images/products/<?= $model['productImage'] ?? '' ?>" alt="" style="width: 350px; ">
          </div>
          <div class="col-lg-5 mt-5">
            <p>Id : <?= $model['productId'] ?></p>
            <p>Name : <?= $model['productName'] ?></p>
            <p>Stock : <?= $model['productStock'] ?></p>
            <p>Color : <?= $model['productColor'] ?></p>
            <p>Capacity : <?= $model['productCapacity'] ?></p>
            <p>Price : <?= $model['productPrice'] ?></p>
            <p>Category : <?= $model['productCategory'] ?></p>
            <p>Modified At : <?= $model['productModifiedAt'] ?></p>
          </div>
          <a class="btn btn-warning col-lg-5 mb-5" href="#" role="button">Edit</a>
        </div>
      </div>
    </div>
  </div>
</div>