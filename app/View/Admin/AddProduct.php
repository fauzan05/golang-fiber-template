    <?php
    if (isset($model['error'])) {
    ?>
        <script>
            alert("<?= $model['error'] ?>");
        </script>
    <?php
    }
    ?>

    <a href="/toko_online/public/admin/productManagement" class="a-back">
        <p class="fa-sharp fa-solid fa-arrow-left"></p> Back
    </a>
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
    <form action="/toko_online/public/admin/addProduct" method="post" enctype="multipart/form-data">
        <div class="form-edit-product1">
            <div class="input-group">
                <label for="image" class="register-label">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="input-group">
                <label for="name" class="register-label">Name</label>
                <input type="text" name="name" class="register-input" placeholder="name" id="name" />
            </div>
            <div class="input-group">
                <label for="category" class="register-label">Category</label>
                <select name="category" id="category">
                    <option value="iPhone">iPhone</option>
                    <option value="iPad">iPad</option>
                    <option value="Mac">Mac</option>
                    <option value="Watch">Watch</option>
                    <option value="Tv">Tv</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>
            <div class="input-group">
                <label for="price" class="register-label">Price</label>
                <input type="text" name="price" class="register-input" placeholder="price" />
            </div>
            <button class="add-product-button"><a class="a">Save</a></button>
        </div>
        <div class="form-edit-product2">
            <div class="input-group">
                <label for="stock" class="register-label">Stock</label>
                <input type="text" name="stock" class="register-input" placeholder="stock" />
            </div>
            <div class="input-group">
                <label for="color" class="register-label">Color</label>
                <select name="color" id="color">
                    <option value="original">Original</option>
                    <option value="grey">Grey</option>
                    <option value="red">Red</option>
                    <option value="space-black">Space Black</option>
                    <option value="white">White</option>
                    <option value="yellow">Yellow</option>
                    <option value="blue">Blue</option>
                    <option value="starlight">Starlight</option>
                    <option value="pink">Pink</option>
                    <option value="black">Black</option>
                </select>
            </div>
            <div class="input-group">
                <label for="capacity" class="register-label">Capacity</label>
                <select name="capacity" id="capacity">
                    <option value="8GB">8 Gb</option>
                    <option value="16GB">16 Gb</option>
                    <option value="32GB">32 Gb</option>
                    <option value="64GB">64 Gb</option>
                    <option value="128GB">128 Gb</option>
                    <option value="256GB">256 Gb</option>
                    <option value="512GB">512 Gb</option>
                    <option value="1TB">1 Tb</option>
                </select>
            </div>
            <div class="input-group">
                <label class="register-label">Description</label>
                <textarea id="description" type="text" name="description" class="register-input-textarea" />
                </textarea>
            </div>
        </div>
    </form>