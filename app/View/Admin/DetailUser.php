<a href="/toko_online/public/admin/userManagement" class="a-back" ><p class="fa-sharp fa-solid fa-arrow-left"></p> Back</a>
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
  </div>
  <div class="detail-product-admin">
    <div class="container-detail-product-admin">
      <img src="" alt="">
      <h5>Id : <?= $model['userId'] ?? ''?></h5>
      <h5>Username : <?= $model['userName'] ?? ''?></h5>
      <h5>Firstname : <?= $model['userFirstname'] ?? ''?></h5>
      <h5>Lastname : <?= $model['userLastname'] ?? ''?></h5>
      <h5>E-mail : <?= $model['userEmail'] ?? ''?></h5>
      <h5>Date of Birth : <?= $model['userDateOfBirth'] ?? ''?></h5>
      <h5>Gender : <?= $model['userGender'] ?? ''?></h5>
      <h5>Phone Number : <?= $model['userPhoneNumber'] ?? ''?></h5>
      <h5>Address : <?= $model['userAddress'] ?? ''?></h5>
      <h5>Jobs : <?= $model['userJobs'] ?? ''?></h5>
      <h5>Status : <?= $model['userStatus'] ?? ''?></h5>
      <h5>Joined At : <?= $model['userJoinedAt'] ?? ''?></h5>
      <br>
      <br>

    </div>
  </div>
