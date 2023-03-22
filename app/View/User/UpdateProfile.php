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
                <?php
                if ($model['userExist'] != null) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link fa-solid fa-cart-shopping mt-1" aria-current="page" href="/toko_online/public/users/cart?category=<?= $category = 'Cart'; ?>"></a>
                    </li>
                <?php
                }
                ?>
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
                            <li><a class="dropdown-item" href="/toko_online/public/users/profile">Profile</a></li>
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
<?php
if ($model['error'] != null) :
?>
    <div class="alert alert-danger text-center" role="alert">
        <?= $model['error'] ?? '' ?>
    </div>
<?php
endif;
?>
<div class="row">
    <div class="container-fluid col-7 my-4" style="border: 1px solid #dee2e6; height:auto; position:absolute; right:10%">
        <h1 class="m-3">Edit Information Account</h1>
        <hr>
        <form action="/toko_online/public/users/updateProfile" method="post">
            <div class="row">
                <input type="text" name="username" value="<?= $model['username'] ?>" hidden>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                    <input type="firstname" name="firstname" class="form-control" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['firstname'] ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                    <input type="lastname" name="lastname" class="form-control" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['lastname'] ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                    <input type="phoneNumber" name="phoneNumber" class="form-control" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['phoneNumber'] ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="phoneNumber" class="form-control" aria-label="Disabled input example" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['email'] ?>" disabled>
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
                    <input type="date" name="dateOfBirth" class="form-control" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['dateOfBirth'] ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="gender">Gender</label>
                    <select class="form-select" name="gender" id="gender" aria-label="Default select example" style="width: 300px;">
                        <option value="null">Choosing Your Gender</option>
                        <?php if ($model['gender'] == 'male') { ?>
                            <option value="<?= $model['gender'] ?>" selected><?= $model['gender'] ?></option>
                            <option value="female">Female</option>
                        <?php } else if ($model['gender'] == 'female') { ?>
                            <option value="male">Male</option>
                            <option value="<?= $model['gender'] ?>" selected><?= $model['gender'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Jobs</label>
                    <input type="jobs" name="jobs" class="form-control" id="exampleFormControlInput1" style="width: 300px;" value="<?= $model['jobs'] ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="5"><?= trim($model['address']) ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary position-button-edit">Update</button>
        </form>
    </div>
</div>
</div>

<div class="row">
    <div class="container-fluid col-2 my-4" style=" height:auto; position:absolute; left:5%">
        <div class="row">
            <a class="col-12 mt-3" href="http://localhost/toko_online/public/users/dashboard" style="text-decoration: none; color:black;">Dashboard</a>
            <hr>
            <a class="col-12 fw-bolder" href="/toko_online/public/users/updateProfile" style="text-decoration: none; color:black;">Account Information</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Orders History</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Track Orders</a>
            <hr>
            <a class="col-12 " href="" style="text-decoration: none; color:black;">Favourite</a>
            <hr>
        </div>

    </div>
</div>