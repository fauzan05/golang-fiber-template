  <hr class="nav-admin-top">
  <h1 class="title-admin-panel">Dashboard</h1>
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
      <h3><?= $model['countAllProducts'] ?? '' ?> Products</h3>
    </div>
    <div class="container-dashboard-admin">
      <h3><?= $model['countAllUsers'] ?? '' ?> Users</h3>
    </div>
  </div>
