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
 <div class="container-dashboard-admin">
  <h3><?= $model['countAllProducts'] ?? '0' ?> Products</h3>
 </div>
</div> 
<div class="list-product-admin">
    <div class="container-list-product-admin">
        <h3>List Of Product</h3>
        <br>
        <br> 
        <table class="table-product">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 50px;">Id</th>
                    <th style="width: 100px;">Name</th>
                    <th style="width: 100px;">Category</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 100px;">Color</th>
                    <th style="width: 100px;">Capacity</th>
                    <th style="width: 130px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $no = 1;
                if (isset($model['showAllProducts'])) {
                    $products = $model['showAllProducts'];
                    foreach ($products as $product) :
                ?>
                <tr>
                    <td style="width: 20px;"><?= $no?></td>
                    <td style="width: 50px;"><?= $product->id ?></td>
                    <td style="width: 100px;"><?= $product->name ?></td>
                    <td style="width: 100px;"><?= $product->category ?></td>
                    <td style="width: 100px;"><?= $product->price ?> IDR</td>
                    <td style="width: 100px;"><?= $product->color ?></td>
                    <td style="width: 100px;"><?= $product->capacity ?></td>
                    <td style="width: 130px;"><button class="edit-button"><a href="/toko_online/public/admin/editProduct?id=<?= $product->id; ?>" class="a">Edit</a></button> <button class="detail-button"><a href="/toko_online/public/admin/detailProduct?id=<?= $product->id; ?>" class="a">Detail</a></button> <button class="delete-button"><a href="/toko_online/public/admin/deleteProduct?id= <?= $product->id; ?>; " class="a">Delete</a></button></td>
                </tr>
                <?php
                  $no++;
                    endforeach;
                }
                ?>
            </tbody>
            
        </table>
    </div>    
</div>

<button class="add-product"><a href="/toko_online/public/admin/addProduct" class="a">Add Product</a></button>


