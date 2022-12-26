<?php

namespace Fauzannurhidayat\PhpMvc\Login\Controller;

use Fauzannurhidayat\PhpMvc\Login\App\View;
use Fauzannurhidayat\PhpMvc\Login\Config\Database;
use Fauzannurhidayat\PhpMvc\Login\Exception\ValidationException;
use Fauzannurhidayat\PhpMvc\Login\Model\UserRegisterRequest;
use Fauzannurhidayat\PhpMvc\Login\Repository\UserRepository;
use Fauzannurhidayat\PhpMvc\Login\Service\UserService;

class UserController
{
    private UserService $userService; 
    
    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }
    public function register()
    {
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

        try{
            $this->userService->register($request);
            //redirect to users/login
            View::Redirect('users/login');
        }catch(ValidationException $exception){
            View::Render('User/Register', [
                'error' => $exception->getMessage()
            ]);
        }
    }
}