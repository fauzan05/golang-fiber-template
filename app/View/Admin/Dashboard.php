<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid m-3">
        <a class="navbar-brand fab fa-apple ms-3 me-5" href="/toko_online/public/" style="letter-spacing: 0.2rem;"><?= $model['logo'] ?? '' ?></a>
        <div class="d-flex flex-row">
            <form class="d-flex" role="search">
                <input class="form-control form-control-sm me-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <a class="fa fa-envelope nav-link ms-5 me-3 mt-2" data-bs-toggle="tooltip" title="Message" href="#"></a>
            <a class="fa fa-right-from-bracket nav-link ms-5 me-5 mt-2" data-bs-toggle="tooltip" title="Logout" href="/toko_online/public/admin/logout"></a>
        </div>
    </div>
    </div>
</nav>

<div class="row no-gutters">
    <div class="col-lg-2 mt-5 bg-dark pt-5 fixed-top" style="z-index: -1; height:100vh;">
        <ul class="nav flex-column mt-5 mb-5 grid gap-0 row-gap-5 ms-5">
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Settings</a>
            </li>
            
        </ul>
    </div>
    <div class="col-lg-10">
    </div>
</div>