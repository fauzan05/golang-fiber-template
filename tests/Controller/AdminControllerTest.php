<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller{
require_once __DIR__ . "/../Helper/Helper.php";
use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;
use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase
{
    private HomeController $homeController;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;
    private AdminController $adminController;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->homeController = new HomeController();
        $this->sessionRepository = new SessionRepository($connection);
        $this->userRepository = new UserRepository($connection);
        $this->adminController = new AdminController();
        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
        $this->userRepository->deleteAllProduct();
        putenv("mode=test");
    }
    public function testLoginAsAdminPage()
    {
            $this->adminController->login();
            $this->expectOutputRegex("[Login Admin]");
            $this->expectOutputRegex("[Username]");
            $this->expectOutputRegex("[Password]");
    }
    public function testAdminLoginSuccess()
    {
        $user = new User();
        $user->id = 12;
        $user->firstname = 'admin';
        $user->lastname = 'admin';
        $user->email = 'admin';
        $user->gender = 'male';
        $user->phoneNumber = '091233243';
        $user->address = 'on earth';
        $user->dateOfBirth = '2001-05-02';
        $user->jobs = 'admin';
        $user->image = '34234234.jpeg';
        $user->username = 'admin';
        $user->password = password_hash('admin', PASSWORD_BCRYPT);
        $user->status = "admin";
        $this->userRepository->save($user);

        $_POST["username"] = "admin";
        $_POST["password"] = "admin";
        $this->adminController->postLogin();
        $this->expectOutputRegex("[Location: /]");
    }
    public function testUpdatePasswordAdmin()
    {
            $user = new User();
            $user->id = 1;
            $user->status = 'admin';
            $user->username = 'admin';
            $user->firstname = "admin";
            $user->password = password_hash("admin", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->homeController->index();
            $this->adminController->updatePassword();
            $_POST['oldPassword'] = "admin";
            $_POST['newPassword'] = "admin1";
            $this->adminController->postUpdatePassword();
            //$this->homeController->index();
            //$this->expectOutputRegex("[Location: /toko_online/public/]");
            $this->expectOutputRegex("[Add Product]");

    }
    public function testAddProduct()
    {
            $user = new User();
            $user->id = 4;
            $user->status = 'admin';
            $user->username = 'adminn';
            $user->firstname = "admin";
            $user->password = password_hash("admin", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['id'] = '1';
            $_POST['name'] = 'iPhone X';
            $_POST['description'] = 'ini adalah iPhone X';
            $_POST['category'] = 'iPhone';
            $_POST['price'] = '10000';
            $this->adminController->postAddProduct();

            $this->homeController->index();
            //$this->expectOutputRegex("[Location: /toko_online/public/]");
            $this->expectOutputRegex("[iPhone X]");
    }
    public function testAddProductFail()
    {
            $user = new User();
            $user->id = 4;
            $user->status = 'admin';
            $user->username = 'admin';
            $user->firstname = "admin";
            $user->password = password_hash("admin", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['id'] = '1';
            $_POST['name'] = 'iPhone X';
            $_POST['description'] = 'ini adalah iPhone X';
            $_POST['category'] = 'iPhone';
            $_POST['price'] = '';
            $this->adminController->postAddProduct();

            $this->expectOutputRegex("[this form don't blank]");
    }
    public function testEditProduct()
    {
        $user = new User();
        $user->id = 4;
        $user->status = 'admin';
        $user->username = 'adminn';
        $user->firstname = "admin";
        $user->password = password_hash("admin", PASSWORD_BCRYPT);
        $this->userRepository->save($user);

        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;
        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $_POST['id'] = '1';
        $_POST['name'] = 'iPhone X';
        $_POST['description'] = 'ini adalah iPhone X';
        $_POST['category'] = 'iPhone';
        $_POST['price'] = '10000';
        $this->adminController->postAddProduct();
    }
    public function testDeleteAllProduct()
    {
        $this->userRepository->deleteAllProduct();
    }

}
}