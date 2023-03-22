<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller;

use Fauzannurhidayat\Php\TokoOnline\App\View;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
use Fauzannurhidayat\Php\TokoOnline\Model\AddToCartRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\BuyNowRequest;
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
        //berfungsi untuk menampilkan halaman register
        View::Render('User/Register', [
            'title' => 'Register New User',
            'logo' => 'iStore',
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
            View::Render('User/Login', [
                'title' => 'Login User',
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
        View::Render(
            'User/Profile',
            [
                'logo' => 'iStore',
                'title' => 'User Profile',
                'userExist' => $session,
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
                'createdAt' => $user->created_at
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
                'userExist' => $session,
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
        View::Render('User/Password', [
            'title' => 'Update User Password',
            'logo' => 'iStore',
            'userExist' => $user,
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
            View::Redirect('/toko_online/public/');
        } catch (ValidationException $exception) {
            View::Render(
                'User/Password',
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
                'logoutButton' => 'Logout',
                'logout' => 'logout'
            ]);
        } else if ($user == null) {
            $showAllProduct = $this->userRepository->showProductByCategory($_GET['category']);
            View::Render('User/ListProduct', [
                'title' => 'iStore',
                'logo' => 'iStore',
                'showAllProduct' => $showAllProduct,
                'logoutButton' => 'Login',
                'login' => 'login'
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
        if(isset($id))
        {
            $this->userRepository->deleteCartById($id);
            View::Redirect('/toko_online/public/users/cart');
        }
        
    }
    public function productDetail()
    {
        $user = $this->sessionService->current();
        $product = $this->userRepository->findProductsById($_GET['id']);
        View::Render(
            'User/ProductDetail',
            [
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
    public function postProductDetail()
    {
        $user = $this->sessionService->current();
        if ($_POST['addToCart'] == 'true') {
            $price = intval($_POST['price']);
            $quantity = intval($_POST['quantity']);
            $request = new AddToCartRequest();
            $request->id = null;
            $request->userId = $user->id;
            $request->total =  $price * $quantity;
            $request->productId = $_POST['id'];
            $request->quantity = $quantity;

            try {
                $this->userService->addToCart($request);
                //redirect to cart
                View::Redirect('/toko_online/public/users/cart');
            } catch (ValidationException $exception) {
                View::Render(
                    'User/ProductDetail',
                    [
                        'error' => $exception->getMessage(),
                        'title' => 'iStore',
                        'logo' => 'iStore',
                        'username' => $user->username
                    ]
                );
            }
        } else if (isset($_POST['buyNow']) == 'true') {
            // var_dump($_POST);
            // die;
            $price = intval($_POST['price']);
            $request = new BuyNowRequest();
            $request->userId = $user->id;
            $request->total = intval($_POST['quantity']);
            $request->amount = intval($price * $request->total);
            $request->productId = $_POST['id'];
            $this->userService->transaction($request);
            View::Redirect('/toko_online/public/users/checkoutStatus');
        }
    }
    public function checkoutStatus()
    {
        $user = $this->sessionService->current();
        View::Render(
            'User/CheckoutStatus',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'userExist' => $user,
                'username' => $user->username,
            ]
        );
    }
    public function transaction()
    {
        $user = $this->sessionService->current();
        View::Render(
            'User/Transaction',
            [
                'title' => 'iStore',
                'logo' => 'iStore',
                'username' => $user->username,
                'userExist' => $user,
            ]
        );
    }
}
