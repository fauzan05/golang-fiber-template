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
            <div class="col-lg-12 overflow-auto" style="border: 1px solid #dee2e6; height:65vh;">
            <form action="/toko_online/public/admin/editProduct" method="post" enctype="multipart/form-data">
        <div class="row gap-5 m-5">
            <div class="col-lg-5">
                <img class="mb-5" src="http://localhost/toko_online/public/assets/images/products/<?= $model['productImage'] ?? '' ?>" alt="" style="width: 350px; ">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02" value="<?= $model['productImage'] ?? '' ?>">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Id </label>
                    <input class="form-control" type="text" placeholder="Disabled input" aria-label="Disabled input example" disabled value="<?= $model['productId'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" value="<?= $model['productName'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleSelectInput" class="form-label">Category </label>
                    <select class="form-select" name="gender" id="exampleSelectInput" aria-label="Default select example" style="width: 300px;">
                        <option value="null">Choose The Category</option>
                        <?php if ($model['productCategory'] == 'iPhone') { ?>
                            <option value="<?= $model['productCategory'] ?>" selected><?= $model['productCategory'] ?></option>
                            <option value="iPad">iPad</option>
                            <option value="Mac">Mac</option>
                            <option value="Watch">Watch</option>
                            <option value="Tv">Tv</option>
                        <?php } else if ($model['productCategory'] == 'iPad') { ?>
                            <option value="iPhone">iPhone</option>
                            <option value="<?= $model['productCategory'] ?>" selected><?= $model['productCategory'] ?></option>
                            <option value="Mac">Mac</option>
                            <option value="Watch">Watch</option>
                            <option value="Tv">Tv</option>
                        <?php } else if ($model['productCategory'] == 'Mac') { ?>
                            <option value="iPhone">iPhone</option>
                            <option value="iPhone">iPad</option>
                            <option value="<?= $model['productCategory'] ?>" selected><?= $model['productCategory'] ?></option>
                            <option value="Watch">Watch</option>
                            <option value="Tv">Tv</option>
                        <?php } else if ($model['productCategory'] == 'Watch') { ?>
                            <option value="iPhone">iPhone</option>
                            <option value="iPhone">iPad</option>
                            <option value="Mac">Mac</option>
                            <option value="<?= $model['productCategory'] ?>" selected><?= $model['productCategory'] ?></option>
                            <option value="Tv">Tv</option>
                        <?php } else if ($model['productCategory'] == 'Tv') { ?>
                            <option value="iPhone">iPhone</option>
                            <option value="iPhone">iPad</option>
                            <option value="Mac">Mac</option>
                            <option value="Watch">Watch</option>
                            <option value="<?= $model['productCategory'] ?>" selected><?= $model['productCategory'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Color </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" value="<?= $model['productColor'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleSelectInput" class="form-label">Capacity </label>
                    <select class="form-select" name="gender" id="exampleSelectInput" aria-label="Default select example" style="width: 300px;">
                        <option value="null">Choose The Capacity</option>
                        <?php if ($model['productCapacity'] == '8GB') { ?>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '16GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '32GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '64GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '128GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '256GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="512GB">512GB</option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '512GB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                            <option value="1TB">1TB</option>
                        <?php } else if ($model['productCapacity'] == '1TB') { ?>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                            <option value="<?= $model['productCapacity'] ?>" selected><?= $model['productCapacity'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Price </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" value="<?= $model['productPrice'] ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>

