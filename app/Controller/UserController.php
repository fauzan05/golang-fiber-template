<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller;

use Fauzannurhidayat\Php\TokoOnline\App\View;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
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

    public function __construct()
    {
        $connection = Database::getConnection('prod');
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function register()
    {
        //berfungsi untuk menampilkan halaman register
        View::Render('User/Register', [
            'title' => 'Register New User'
        ]);
    }
    public function postRegister()
    {
        //berfungsi untuk menangkap data yang berada di form
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            //redirect to users/login
            View::Redirect('/PHP_MVC_LOGIN/public/users/login');
        } catch (ValidationException $exception) {
            View::Render('User/Register', [
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function login()
    {
        View::Render('User/Login', [
            'title' => 'Login User'
        ]);
    }
    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->id = $_POST['id'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            //redirect to users/dashboard
            View::Redirect('/PHP_MVC_LOGIN/public/');
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
        View::Redirect("/PHP_MVC_LOGIN/public/");
    }
    public function updateProfile()
    {
        $user = $this->sessionService->current();
        View::Render(
            'User/Profile',
            [
                'title' => 'Update User Profile',
                'user' => [
                    "id" => $user->id,
                    "name" => $user->name
                ]
            ]
        );
    }
    public function postUpdateProfile()
    {
        $user = $this->sessionService->current();

        $request = new UserProfileUpdateRequest();
        $request->id = $user->id;
        $request->name = $_POST['name'];

        try {
            $this->userService->updateProfile($request);
            //redirect ke halaman dashboard
            View::Redirect('/PHP_MVC_LOGIN/public/');
        } catch (ValidationException $exception) {
            View::Render(
                'User/Profile',
                [
                    'title' => 'Update User Profile',
                    'error' => $exception->getMessage(),
                    'user' => [
                        "id" => $user->id,
                        "name" => $user->name
                    ]
                ]
            );
        }
    }
    public function updatePassword()
    {
        $user = $this->sessionService->current();
        View::Render('User/Password', [
            "title" => "Update User Password",
            "user" => [
                "id" => $user->id
            ]
        ]);
    }
    public function postUpdatePassword()
    {
        $user = $this->sessionService->current();

        $request = new UserPasswordUpdateRequest();
        $request->id = $user->id;
        $request->oldPassword = $_POST['oldPassword'];
        $request->newPassword = $_POST['newPassword'];

        try {
            $this->userService->updatePassword($request);
            //redirect ke halaman dashboard
            View::Redirect('/PHP_MVC_LOGIN/public/');
        } catch (ValidationException $exception) {
            View::Render(
                'User/Password',
                [
                    'title' => 'Update User Password',
                    'error' => $exception->getMessage(),
                    'user' => [
                        "id" => $user->id,
                    ]
                ]
            );
        }
    }
}
