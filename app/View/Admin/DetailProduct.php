<a href="/toko_online/public/admin/productManagement" class="a-back" ><p class="fa-sharp fa-solid fa-arrow-left"></p> Back</a>
  <hr class="nav-admin-top">
  <h1 class="title-admin-panel">Product</h1>
  <nav class="nav-admin">
    <div class="logo-admin">
      <h4 class="fab fa-apple"> iStore</h4>
    </div>
    <ul class="nav-menu-admin">
      <li class="nav-item-admin"><a class="nav-link-admin" href="/toko_online/public/">Dashboard</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="/toko_online/public/admin/productManagement">Product</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="#">Category</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="/toko_online/public/admin/userManagement">User</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="#">Order</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="#">Sales Report</a></li>
      <li class="nav-item-admin"><a class="nav-link-admin" href="/toko_online/public/admin/logout">Logout</a></li>
    </ul>
    <div class="hamburger">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </nav>
  <div class="dashboard-admin">
  </div>
  <div class="detail-product-admin">
    <div class="container-detail-product-admin">
      <img src="<?= $model['imageLocation'] . $model['productImage'] ?? '' ?>">
      <h5>Id : <?= $model['productId']?></h5>
      <h5>Name : <?= $model['productName']?></h5>
      <h5>Category : <?= $model['productCategory']?></h5>
      <h5>Price : <?= $model['productPrice']?></h5>
      <h5>Color : <?= $model['productColor']?></h5>
      <h5>Capacity : <?= $model['productCapacity']?></h5>
      <h5>Description : <?= $model['productDescription']?></h5>
      <h5>Created_at : <?= $model['productCreatedAt']?></h5>
      <h5>Modified_at : <?= $model['productModifiedAt']?></h5>
      <br>
      <br>

    </div>
  </div>
