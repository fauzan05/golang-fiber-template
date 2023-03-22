<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller;

use Fauzannurhidayat\Php\TokoOnline\App\View;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;

class HomeController
{
    private SessionService $sessionService;
    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = Database::getConnection('prod');
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->userRepository = new UserRepository($connection);
    }
    function index()
    {
        $user = $this->sessionService->current();
        if($user == null)
        {
            $showAllProduct = $this->userRepository->showAllProduct();
            View::Render('Home/Index', [
                'title' => 'iStore',
                'logo' => 'iStore',
                'showAllProduct' => $showAllProduct,
                'userExist' => null
            ]);
        }else if ($user->status == 'user'){
            $showAllProduct = $this->userRepository->showAllProduct();
            View::Render('User/Dashboard', [
                'title' => 'iStore',
                'logo' =>'iStore',
                'user' => $user->username,
                'showAllProduct' => $showAllProduct,
                'userExist' => $user
            ]);
        }else if($user->status == 'admin'){
            $countProducts = $this->userRepository->countAllProduct();
            $countUsers = $this->userRepository->countAllUsers();
            View::Render('Admin/Dashboard', [
                'title' => 'iStore Admin',
                'user' => $user->username,
                'countAllProducts' => $countProducts,
                'countAllUsers' => $countUsers        
            ]);
        }
        
    }
}