<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <?php if (isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3"><?= $model['title'] ?></h1>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/toko_online/public/admin/editProduct">
                <div class="form-floating mb-3">
                    <input name="id" type="hidden" class="form-control" id="id" placeholder="id" value="<?= $model['productId'] ?>">
                </div>
                <div class="form-floating mb-3">
                    <input name="name" type="text" class="form-control" id="nama" placeholder="nama" value="<?= $model['productName'] ?>">
                    <label for="name">Name of Product</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="description" type="text" class="form-control" id="description" placeholder="deskripsi" value="<?= $model['productDescription'] ?>">
                    <label for="description">Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="category" type="text" class="form-control" id="category" placeholder="kategori" value="<?= $model['productCategory'] ?>">
                    <label for="category">Category</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="price" type="text" class="form-control" id="category" placeholder="harga"  value="<?= $model['productPrice'] ?>">
                    <label for="price">Price</label>
                </div>
                <div class="form-group mb-3">
                    <input name="price" type="file" class="form-control" id="category" placeholder="harga"  value="">
                    <label for="price">Price</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit"><?= $model['submit']?></button>
            </form>
        </div>
    </div>
</div>