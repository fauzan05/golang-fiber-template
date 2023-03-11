<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Hello <?= $model['user'] ?? '' ?> !</h1>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <div class="p-4 p-md-5 border rounded-3 bg-light">
                <div class="form-floating mb-3">
                    <a href="/toko_online/public/admin/password" class="w-100 btn btn-lg btn-primary">Password</a>
                </div>
                <div class="form-floating mb-3">
                    <a href="/toko_online/public/admin/addProduct" class="w-100 btn btn-lg btn-primary">Add Product</a>
                </div>
                <div class="form-floating mb-3">
                    <a href="/toko_online/public/admin/logout" class="w-100 btn btn-lg btn-danger">Logout</a>
                </div>
            </div>
        </div>
        <h2>Total Products : <?= $model['countProducts'] ?></h2>
        <h2>Products List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Modified At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (isset($model['products'])) {
                    $products = $model['products'];
                    foreach ($products as $produk) :
                ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $produk->id ?></td>
                            <td><?= $produk->name ?></td>
                            <td><?= $produk->description ?></td>
                            <td><?= $produk->category ?></td>
                            <td><?= $produk->price ?></td>
                            <td><?= $produk->created_at ?></td>
                            <td><?= $produk->modified_at ?></td>
                            <td> <a class="btn btn-sm btn-danger" href="/toko_online/public/admin/deleteProduct?id=<?= $produk->id; ?>">Delete</a> 
                            | <a class="btn btn-sm btn-success" href="/toko_online/public/admin/editProduct?id=<?= $produk->id; ?>">Edit</a></td>
                        </tr>
                <?php
                    $i++;
                    endforeach;
                }
                ?>
            </tbody>
        </table>
        <h2>List of User</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (isset($model['users'])) {
                    $users = $model['users'];
                    foreach ($users as $user) :
                ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $user->id ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->name ?></td>
                            <td><?= $user->status ?></td>
                            <td> <a class="btn btn-sm btn-danger" href="/toko_online/public/admin/deleteUser?id=<?= $user->id; ?>">Delete</a> 
                            | <a class="btn btn-sm btn-success" href="/toko_online/public/admin/editUser?id=<?= $user->id; ?>">Edit</a></td>
                        </tr>
                <?php
                    $i++;
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>