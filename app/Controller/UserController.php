<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller;

use Fauzannurhidayat\Php\TokoOnline\App\View;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
use Fauzannurhidayat\Php\TokoOnline\Model\AddToCartRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\BuyNowRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\TopUpRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserLoginRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserPasswordUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserProfileUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserRegisterRequest;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;
use Fauzannurhidayat\Php\TokoOnline\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;
    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = Database::getConnection('prod');
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $this->userRepository);
    }
    public function register()
    {
        View::Render('User/Register', [
            'title' => 'Register New User',
            'logo' => 'iStore',
            'error' => null
        ]);
    }
    public function postRegister()
    {
        //berfungsi untuk menangkap data yang berada di form
        $request = new UserRegisterRequest();
        $request->id = null;
        $request->username = $_POST['username'];
        $request->firstname = $_POST['firstname'];
        $request->lastname = $_POST['lastname'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->dateOfBirth = $_POST['dateOfBirth'];
        $request->gender = $_POST['gender'];
        $request->phoneNumber = $_POST['phoneNumber'];
        $request->jobs = $_POST['jobs'];
        $request->address = $_POST['address'];
        $request->status = 'user';
        try {
            $this->userService->register($request);
            //redirect to users/login
            View::Redirect('/toko_online/public/users/login');
        } catch (ValidationException $exception) {
            View::Render('User/Register', [
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function login()
    {
        View::Render('User/Login', [
            'title' => 'Login User',
            'logo' => 'iStore',
            'error' => null
        ]);
    }
    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->loginUser($request);
            if ($response->user->status == 'user') {
                $this->sessionService->createByEmail($response->user->email);
                //redirect to users/dashboard
                View::Redirect('/toko_online/public/');
            }
            View::Render('User/Login', [
                'title' => 'Login User',
                'error' => 'Username or password is wrong'
            ]);
        } catch (ValidationException $exception) {
            // var_dump($exception);
            // die;
            View::Render('User/Login', [
                'title' => 'Login User',
                'logo' => 'iStore',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function logout()
    {
        $this->sessionService->destroy();
        View::Redirect('/toko_online/public/');
    }
    public function profile()
    {
        $session = $this->sessionService->current();
        $user = $this->userRepository->findByUsername($session->username);
        $transaction = $this->userRepository->countAllTransactionById($session->id);
        View::Render(
            'User/Profile',
            [
                'logo' => 'iStore',
                'title' => 'User Profile',
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'gender' => $user->gender,
                'phoneNumber' => $user->phoneNumber,
                'address' => $user->address,
                'jobs' => $user->jobs,
                'balance' => $user->balance,
                'dateOfBirth' => $user->dateOfBirth,
                'username' => $user->username,
                'status' => $user->status,
                'createdAt' => $user->created_at,
                'countAllTransaction' => $transaction
            ]
        );
    }
    public function updateProfile()
    {
        $session = $this->sessionService->current();
        $user = $this->userRepository->findByUsername($session->username);
        View::Render(
            'User/UpdateProfile',
            [
                'title' => 'Update User Profile',
                'logo' => 'iStore',
                'error' => null,
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'gender' => $user->gender,
                'phoneNumber' => $user->phoneNumber,
                'address' => $user->address,
                'jobs' => $user->jobs,
                'dateOfBirth' => $user->dateOfBirth,
                'username' => $user->username,
                'status' => $user->status
            ]
        );
    }
    public function postUpdateProfile()
    {
        $session = $this->sessionService->current();
        $user = $this->userRepository->findByUsername($session->username);

        $request = new UserProfileUpdateRequest();
        $request->username = $_POST['username'];
        $request->firstname = $_POST['firstname'];
        $request->lastname = $_POST['lastname'];
        $request->gender = $_POST['gender'];
        $request->phoneNumber = $_POST['phoneNumber'];
        $request->jobs = $_POST['jobs'];
        $request->dateOfBirth = $_POST['dateOfBirth'];
        $request->address = $_POST['address'];

        try {
            $this->userService->updateProfile($request);
            //redirect ke halaman dashboard
            View::Redirect('/toko_online/public/users/dashboard');
        } catch (ValidationException $exception) {
            View::Render(
                'User/UpdateProfile',
                [
                    'title' => 'Update User Profile',
                    'error' => $exception->getMessage(),
                    'title' => 'Update User Profile',
                    'logo' => 'iStore',
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'phoneNumber' => $user->phoneNumber,
                    'address' => $user->address,
                    'jobs' => $user->jobs,
                    'dateOfBirth' => $user->dateOfBirth,
                    'username' => $user->username,
                    'status' => $user->status
                ]
            );
        }
    }
    public function updatePassword()
    {
        $user = $this->sessionService->current();
        View::Render('User/UpdatePassword', [
            'title' => 'Update User Password',
            'logo' => 'iStore',
            'error' => null,
            'username' => $user->username
        ]);
    }
    public function postUpdatePassword()
    {
        $user = $this->sessionService->current();
        $request = new UserPasswordUpdateRequest();
        $request->username = $user->username;
        $request->oldPassword = $_POST['oldPassword'];
        $request->newPassword = $_POST['newPassword'];

        try {
            $this->userService->updatePassword($request);
            //redirect ke halaman dashboard
            View::Redirect('/toko_online/public/users/dashboard');
        } catch (ValidationException $exception) {
            View::Render(
                'User/UpdatePassword',
                [
                    'title' => 'Update User Password',
                    'error' => $exception->getMessage(),
                    'username' => $user->username,

                ]
            );
        }
    }
    public function listProduct()
    {
        if ($user = $this->sessionService->current()) {
            $showAllProduct = $this->userRepository->showProductByCategory($_GET['category']);
            View::Render('User/ListProduct', [
                'title' => 'iStore',
                'logo' => 'iStore',
                'username' => $user->username,
                'showAllProduct' => $showAllProduct,
            ]);
        } else if ($user == null) {
            $showAllProduct = $this->userRepository->showProductByCategory($_GET['category']);
            View::Render('User/ListProduct', [
                'title' => 'iStore',
                'logo' => 'iStore',
                'showAllProduct' => $showAllProduct,
            ]);
        }
    }
    public function cart()
    {
        $user = $this->sessionService->current();
        $cartsArray = $this->userRepository->showAllCart($user->id);

        View::Render(
            'User/Cart',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'error' => null,
                'userExist' => $user,
                'username' => $user->username,
                'cartsArray' => $cartsArray
            ]
        );
    }
    public function deleteCart()
    {
        $this->sessionService->current();
        View::Render('User/Delete', []);
        $id = trim($_GET['id']);
        if (isset($id)) {
            $this->userRepository->deleteCartById($id);
            View::Redirect('/toko_online/public/users/cart');
        }
    }
    public function productDetail()
    {
        $user = $this->sessionService->current();
        $id = $_GET['id'];
        if (isset($id)) {
            $product = $this->userRepository->findProductsById($id);
            View::Render(
                'User/ProductDetail',
                [
                    'title' => 'iStore',
                    'logo' => 'iStore',
                    'error' => null,
                    'addToCart' => null,
                    'buyNow' => null,
                    'username' => $user->username,
                    'productId' => $product->id,
                    'productName' => $product->name,
                    'productStock' => $product->stock,
                    'productColor' => $product->color,
                    'productCapacity' => $product->capacity,
                    'productPrice' => $product->price,
                    'productImage' => $product->image,
                    'productDescription' => $product->description
                ]
            );
        } else {
            View::Render(
                'User/ProductDetail',
                [
                    'title' => 'iStore',
                    'logo' => 'iStore',
                    'username' => $user->username
                ]
            );
        }
    }
    public function postProductDetail()
    {
        $user = $this->sessionService->current();
        $productId = $_POST['id'];
        $price = intval($_POST['price']);
        $quantity = $_POST['quantity'];
        if ($_POST['addToCart'] == 'true') {
            $request = new AddToCartRequest();
            $request->id = null;
            $request->stock = $_POST['stock'];
            $request->quantity = $quantity;
            $request->userId = $user->id;
            $request->price = $price;
            $request->productId = $productId;
            try {
                $this->userService->addToCart($request);
                //redirect to cart
                View::Redirect('/toko_online/public/users/cart');
            } catch (ValidationException $exception) {
                $product = $this->userRepository->findProductsById($productId);
                View::Render(
                    'User/ProductDetail',
                    [
                        'error' => $exception->getMessage(),
                        'title' => 'iStore',
                        'logo' => 'iStore',
                        'username' => $user->username,
                        'productId' => $product->id,
                        'productName' => $product->name,
                        'productStock' => $product->stock,
                        'productColor' => $product->color,
                        'productCapacity' => $product->capacity,
                        'productPrice' => $product->price,
                        'productImage' => $product->image,
                        'productDescription' => $product->description
                    ]
                );
            }
        } else if (isset($_POST['buyNow']) == 'true') {

            $request = new BuyNowRequest();
            $request->balanceUser = $this->userRepository->checkUserBalance($user->id)->balance;
            $request->price = intval($_POST['price']);
            $request->stock = $_POST['stock'];
            $request->userId = $user->id;
            $request->total = intval($_POST['quantity']);
            $request->productId = $_POST['id'];
            try {
                $this->userService->transaction($request);
                View::Redirect('/toko_online/public/users/checkoutStatus');
            } catch (ValidationException $exception) {
                $product = $this->userRepository->findProductsById($productId);
                View::Render(
                    'User/ProductDetail',
                    [
                        'error' => $exception->getMessage(),
                        'title' => 'iStore',
                        'logo' => 'iStore',
                        'username' => $user->username,
                        'productId' => $product->id,
                        'productName' => $product->name,
                        'productStock' => $product->stock,
                        'productColor' => $product->color,
                        'productCapacity' => $product->capacity,
                        'productPrice' => $product->price,
                        'productImage' => $product->image,
                        'productDescription' => $product->description
                    ]
                );            }
        }
    }
    public function checkoutStatus()
    {
        $user = $this->sessionService->current();
        $order = $this->userRepository->showLatestTransaction($user->id);
        View::Render(
            'User/CheckoutStatus',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'userExist' => $user,
                'username' => $user->username,
                'showLatestOrder' => $order
            ]
        );
    }
    public function orderHistory()
    {
        $user = $this->sessionService->current();
        $order = $this->userRepository->showAllTransaction($user->id);
        $count = $this->userRepository->countAllTransactionById($user->id);
        View::Render(
            'User/OrderHistory',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'username' => $user->username,
                'userExist' => $user,
                'showAllOrder' => $order,
                'countAllTransaction' => $count
            ]
        );
    }
    public function topUp()
    {
        $user = $this->sessionService->current();
        $showBalance = $this->userRepository->checkBalance($user->username);
        View::Render(
            'User/TopUp',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'error' => null,
                'showBalance' => $showBalance,
                'username' => $user->username
            ]
        );
    }
    public function postTopUp()
    {
        $user = $this->sessionService->current();
        $showBalance = $this->userRepository->checkBalance($user->username);
        $request = new TopUpRequest();
        $request->username = $_POST['username'];
        $request->balance = $_POST['balance'];
        try {
            $this->userService->topUpService($request);
            View::Redirect('/toko_online/public/users/dashboard');
        } catch (ValidationException $exception) {
            View::Render(
                'User/TopUp',
                [
                    'title' => 'iStore',
                    'logo' => 'iStore',
                    'error' => $exception->getMessage(),
                    'showBalance' => $showBalance
                ]
            );
        }
    }
    public function about()
    {
        View::Render(
            'Users/About',
            [
                'title' => 'iStore',
                'logo' => 'iStore'
            ]
        );
    }
}
