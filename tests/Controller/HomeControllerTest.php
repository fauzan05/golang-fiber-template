<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    private HomeController $homeController;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->homeController = new HomeController();
        $this->sessionRepository = new SessionRepository($connection);
        $this->userRepository = new UserRepository($connection);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
    }

    public function testGuest()
    {
        $this->homeController->index();

        $this->expectOutputRegex("[Login]");
        $this->expectOutputRegex("[Register]");
    }
    public function testUserLogin()
    {
        $user = new User();
        $user->id = '13';
        $user->firstname = 'fauzan';
        $user->lastname = 'nurhidayat';
        $user->email = "fauzannurhidayat8@gmail.com";
        $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
        $user->gender = 'male';
        $user->phoneNumber = '081335457601';
        $user->address = 'jakarta timur';
        $user->jobs = 'junior programmer';
        $user->dateOfBirth = '2001-02-05';
        $user->username = 'fauzan14';
        $user->image = '';
        $user->status = 'user';

        $this->userRepository->save($user);

        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;
        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->homeController->index();

        $this->expectOutputRegex("[Logout]");
        $this->expectOutputRegex("[Profile]");
        
    }
}
