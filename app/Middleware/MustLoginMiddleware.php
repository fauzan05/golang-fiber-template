<?php

namespace Fauzannurhidayat\Php\TokoOnline\Middleware;

use Fauzannurhidayat\Php\TokoOnline\App\View;
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;

class MustLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function before():void
    {
        $user = $this->sessionService->current(); //ada session usernya
        if($user == null)
        {
            View::Redirect('/toko_online/public/users/login');
        }
    }
}