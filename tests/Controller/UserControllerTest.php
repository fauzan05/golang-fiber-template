<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller {

    require_once __DIR__ . "/../Helper/Helper.php";

    use Fauzannurhidayat\Php\TokoOnline\Config\Database;
    use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
    use Fauzannurhidayat\Php\TokoOnline\Domain\User;
    use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
    use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
    use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
    use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;
    use PHPUnit\Framework\TestCase;

    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        protected function setUp(): void
        {
            $connection = Database::getConnection();
            $this->userController = new UserController();
            $this->sessionRepository = new SessionRepository($connection);
            $this->sessionRepository->deleteAll();
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();
            putenv("mode=test");
        }
        public function testRegister()
        {
            $this->userController->register();
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
        }
        public function testPostRegisterSuccess()
        {
            $_POST['username'] = "14";
            $_POST['name'] = "Fauzan14";
            $_POST['password'] = "yaya";

            $this->userController->postRegister();
            //$this->expectOutputString("");
            $this->expectOutputRegex('[Location: /toko_online/public/users/login]');
        }
        public function testPostRegisterFailed()
        {
            $_POST['id'] = "";
            $_POST['name'] = "Fauzan";
            $_POST['password'] = "Gatau";

            $this->userController->postRegister();

            $this->expectOutputRegex("[Password cannot blank]");
        }
        public function testPostRegisterDuplicated()
        {
            $user = new User();
            $user->username = "fauzan";
            $user->password = "fauzan";

            $this->userRepository->save($user);

            $_POST['id'] = "fauzan";
            $_POST['name'] = "fauzan";
            $_POST['password'] = "fauzan";

            $this->userController->postRegister();
            $this->expectOutputRegex("[User already exist]");
            //$this->expectOutputRegex("[Location: users/login]");
            //$this->expectOutputRegex("[Register]");
        }
        public function testLogin()
        {
            $this->userController->login();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
        }
        public function testLoginSuccess()
        {
            //ekspetasi : membuat akun user (registrasi)
            $user = new User();
            $user->id = null;
            $user->username = "User1";
            $user->status = 'user';
            $user->password = password_hash("User1", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            //ekspetasi : memasukkan username dan password
            $_POST['username'] = "User1";
            $_POST['password'] = "User1";
            $this->userController->postLogin();
            
            //ekspetasi : redirect ke halaman dashboard
            $this->expectOutputRegex("[Location: /]");
        }

        public function testLoginValidationError()
        {
            $_POST['id'] = "";
            $_POST['password'] = "";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id, Name, Password cannot blank]");
        }
        public function testLoginUserNotFound()
        {
            $_POST['id'] = "HAHA";
            $_POST['password'] = "HAHA";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id or password is wrong]");
        }
        public function testLoginWrongPassword()
        {
            $_POST['id'] = "yaya";
            $_POST['password'] = "HAHA";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id or password is wrong]");
        }
        public function testLogout()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->userController->logout();

            $this->expectOutputRegex("[Location: /]");
            $this->expectOutputRegex("[FZN : ]");
        }
        public function testUpdateProfile()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->userController->updateProfile();

            $this->expectOutputRegex("[Profile]");
            $this->expectOutputRegex("[Id]");
        }
        public function testPostUpdateProfileSuccess()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['name'] = 'Zane';
            $this->userController->postUpdateProfile();

            $this->expectOutputRegex("[Location: /PHP_MVC_LOGIN/public/]");
            $this->expectOutputRegex("[Location: /]");

            $result = $this->userRepository->findById($user->id);
            // self::assertEquals($_POST['name'], $result->name);
        }
        public function testPostUpdateProfileValidationError()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['name'] = '';
            $this->userController->postUpdateProfile();

            $this->expectOutputRegex("[Profile]");
            $this->expectOutputRegex("[Name cannot blank]");
        }
        public function testUpdatePassword()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $this->userController->updatePassword();

            $this->expectOutputRegex("[newPassword]");
            $this->expectOutputRegex("[14]");
            $this->expectOutputRegex("[oldPassword]");
        }
        public function testPostUpdatePasswordSuccess()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['oldPassword'] = "Fauzan14";
            $_POST['newPassword'] = "yaya";
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[Location: /PHP_MVC_LOGIN/public/]");

            $result = $this->userRepository->findById($user->id);
            self::assertTrue(password_verify($_POST['newPassword'], $result->password));
        }
        public function testPostUpdatePasswordValidationError()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['oldPassword'] = "sdad";
            $_POST['newPassword'] = "";
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[newPassword]");
            $this->expectOutputRegex("[14]");
            $this->expectOutputRegex("[oldPassword]");
            $this->expectOutputRegex("[Old Password, New Password cannot blank]");
        }
        public function testPostUpdatePasswordWrongOldPassword()
        {
            $user = new User();
            $user->id = "14";
            $user->password = password_hash("Fauzan14", PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $_POST['oldPassword'] = 'salah';
            $_POST['newPassword'] = 'salah';
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[Old password is wrong!]");
        }
        public function testAddToShoppingSession()
        {
            $user = new User();
            
        }
     }
}
