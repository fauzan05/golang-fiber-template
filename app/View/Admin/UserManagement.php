    <hr class="nav-admin-top">
   <h1 class="title-admin-panel">User</h1>
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
  <h3><?= $model['countAllUsers'] ?? '0' ?> User</h3>
 </div>
</div> 
<div class="list-product-admin">
    <div class="container-list-product-admin">
        <h3>List Of User</h3>
        <br>
        <br> 
        <table class="table-product">
            <thead>
                <tr>
                <th style="width: 20px;">No</th>
                    <th style="width: 50px;">Id</th>
                    <th style="width: 100px;">Username</th>
                    <th style="width: 100px;">E-mail</th>
                    <th style="width: 100px;">Gender</th>
                    <th style="width: 130px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $no = 1;
                if (isset($model['showAllUsers'])) {
                    $users = $model['showAllUsers'];
                    foreach ($users as $user) :
                ?>
                <tr>
                <td style="width: 20px;"><?= $no?></td>
                    <td style="width: 50px;"><?= $user->id ?></td>
                    <td style="width: 100px;"><?= $user->username ?></td>
                    <td style="width: 100px;"><?= $user->email ?></td>
                    <td style="width: 100px;"><?= $user->gender ?></td>
                    <td style="width: 130px;"><button class="detail-button"><a href="/toko_online/public/admin/detailUser?id=<?= $user->id; ?>"" class="a">Detail</a></button> <button class="delete-button"><a href="/toko_online/public/admin/deleteUser?id=<?= $user->id; ?>" class="a">Delete</a></button></td>
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

<button class="add-product-button">Add User</button>


