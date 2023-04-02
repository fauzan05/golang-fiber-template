<?php

namespace Fauzannurhidayat\Php\TokoOnline\Controller {

    require_once __DIR__ . "/../Helper/Helper.php";

    use Fauzannurhidayat\Php\TokoOnline\Config\Database;
    use Fauzannurhidayat\Php\TokoOnline\Domain\Product;
    use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
    use Fauzannurhidayat\Php\TokoOnline\Domain\User;
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
            $this->expectOutputRegex("[Username]");
            $this->expectOutputRegex("[Lastname]");
            $this->expectOutputRegex("[Address]");
        }
        public function testPostRegisterSuccess()
        {
            $_POST['username'] = "fauzan14";
            $_POST['firstname'] = "fauzan";
            $_POST['lastname'] = "nur hidayat";
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = password_hash("fauzan123", PASSWORD_BCRYPT);
            $_POST['gender'] = 'male';
            $_POST['phoneNumber'] = '081335457601';
            $_POST['address'] = 'jakarta timur';
            $_POST['jobs'] = 'junior programmer';
            $_POST['dateOfBirth'] = '2001-02-05';
            $this->userController->postRegister();

            $this->expectOutputRegex('[Location: /toko_online/public/users/login]');
        }
        public function testPostRegisterFailed()
        {
            $_POST['username'] = "fauzan14";
            $_POST['firstname'] = "fauzan";
            $_POST['lastname'] = "nur hidayat";
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = password_hash("fauzan123", PASSWORD_BCRYPT);
            $_POST['gender'] = 'male';
            $_POST['phoneNumber'] = '081335457601';
            $_POST['address'] = 'jakarta timur';
            $_POST['jobs'] = 'junior programmer';
            $_POST['dateOfBirth'] = null; // showing an exception

            $this->userController->postRegister();

            $this->expectOutputRegex("[Either of these forms cannot be empty]");
        }
        public function testPostRegisterDuplicated()
        {
            $user = new User();
            $user->id = '13';
            $user->firstname = 'fauzan';
            $user->lastname = 'nurhidayat';
            $user->email = "fauzannurhidayat8@gmail.com";
            $user->password = password_hash("fauzan123", PASSWORD_BCRYPT);
            $user->gender = 'male';
            $user->phoneNumber = '081335457601';
            $user->address = 'jakarta timur';
            $user->jobs = 'junior programmer';
            $user->dateOfBirth = '2001-02-05';
            $user->username = 'fauzan14';
            $user->image = '';
            $user->status = 'user';

            $this->userRepository->save($user);

            $_POST['username'] = "fauzan14";
            $_POST['firstname'] = "fauzan";
            $_POST['lastname'] = "nurhidayat";
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = password_hash("fauzan123", PASSWORD_BCRYPT);
            $_POST['gender'] = 'male';
            $_POST['phoneNumber'] = '081335457601';
            $_POST['address'] = 'jakarta timur';
            $_POST['jobs'] = 'junior programmer';
            $_POST['dateOfBirth'] = '2001-02-05';

            $this->userController->postRegister();
            $this->expectOutputRegex("[Username is already exist]");
        }
        public function testLogin()
        {
            $this->userController->login();
            $this->expectOutputRegex("[Email]");
            $this->expectOutputRegex("[Password]");
        }
        public function testLoginSuccess()
        {
            //ekspetasi : membuat akun user (registrasi)
            $user = new User();
            $user->id = '13';
            $user->firstname = 'fauzan';
            $user->lastname = 'nurhidayat';
            $user->email = "fauzannurhidayat8@gmail.com";
            $user->password = password_hash("fauzan123", PASSWORD_BCRYPT);
            $user->gender = 'male';
            $user->phoneNumber = '081335457601';
            $user->address = 'jakarta timur';
            $user->jobs = 'junior programmer';
            $user->dateOfBirth = '2001-02-05';
            $user->username = 'fauzan14';
            $user->image = '';
            $user->status = 'user';
            $this->userRepository->save($user);

            //ekspetasi : memasukkan username dan password
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = "fauzan123";
            $this->userController->postLogin();

            //ekspetasi : redirect ke halaman dashboard
            $this->expectOutputRegex("[Location: /]");
        }

        public function testLoginValidationError()
        {
            $_POST['email'] = "";
            $_POST['password'] = "";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Email or Password cannot empty]");
        }
        public function testLoginUserNotFound()
        {
            $_POST['email'] = "HAHA";
            $_POST['password'] = "HAHA";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Email or password is wrong]");
        }
        public function testLoginWrongPassword()
        {
            $_POST['email'] = "yaya";
            $_POST['password'] = "HAHA";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login User]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Email or password is wrong]");
        }
        public function testLogout()
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

            $this->userController->logout();

            $this->expectOutputRegex("[Location: /]");
            $this->expectOutputRegex("[Cookie : Location: /toko_online/public/]");
        }
        public function testProfile()
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

            $this->userController->profile();

            $this->expectOutputRegex("[Balance]");
            $this->expectOutputRegex("[fauzan14]");
        }
        public function testUpdateProfile()
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

            $this->userController->updateProfile();

            $this->expectOutputRegex("[fauzan14]");
        }
        public function testPostUpdateProfileSuccess()
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

            $_POST['username'] = "fauzan14";
            $_POST['firstname'] = "fauzan";
            $_POST['lastname'] = "nurhidayat";
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = password_hash("fauzan123", PASSWORD_BCRYPT);
            $_POST['gender'] = 'male';
            $_POST['phoneNumber'] = '081335457601';
            $_POST['address'] = 'jakarta timur';
            $_POST['jobs'] = 'junior programmer';
            $_POST['dateOfBirth'] = '2001-02-05';

            $this->userController->postUpdateProfile();
            $this->expectOutputRegex("[Location: /toko_online/public/users/dashboard]");

            $result = $this->userRepository->findById($user->id);
            self::assertEquals($_POST['username'], $result->username);
        }
        public function testPostUpdateProfileValidationError()
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

            $_POST['username'] = 'fauzan14';
            $_POST['firstname'] = "";
            $_POST['lastname'] = "nurhidayat";
            $_POST['email'] = "fauzannurhidayat8@gmail.com";
            $_POST['password'] = password_hash("fauzan123", PASSWORD_BCRYPT);
            $_POST['gender'] = 'male';
            $_POST['phoneNumber'] = '081335457601';
            $_POST['address'] = 'jakarta timur';
            $_POST['jobs'] = 'junior programmer';
            $_POST['dateOfBirth'] = '2001-02-05';

            $this->userController->postUpdateProfile();
            $this->expectOutputRegex("[Either of these forms cannot be empty]");

            $result = $this->userRepository->findById($user->id);
            self::assertEquals($_POST['username'], $result->username);
        }
        public function testUpdatePassword()
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

            $this->userController->updatePassword();

            $this->expectOutputRegex("[New Password]");
            $this->expectOutputRegex("[Old Password]");
        }
        public function testPostUpdatePasswordSuccess()
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

            $this->userController->updatePassword();

            $_POST['oldPassword'] = "Fauzan14";
            $_POST['newPassword'] = "yaya";
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[Location: /toko_online/public/users/dashboard]");

            $result = $this->userRepository->findById($user->id);
            self::assertTrue(password_verify($_POST['newPassword'], $result->password));
        }
        public function testPostUpdatePasswordValidationError()
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

            $_POST['oldPassword'] = "";
            $_POST['newPassword'] = "yaya";
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[Old Password, New Password cannot empty]");

            $result = $this->userRepository->findById($user->id);
            self::assertNotTrue(password_verify($_POST['newPassword'], $result->password));
        }
        public function testPostUpdatePasswordWrongOldPassword()
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

            $_POST['oldPassword'] = "asdad";
            $_POST['newPassword'] = "yaya";
            $this->userController->postUpdatePassword();

            $this->expectOutputRegex("[Old password is wrong!]");

            $result = $this->userRepository->findById($user->id);
            self::assertNotTrue(password_verify($_POST['newPassword'], $result->password));
        }
        public function testTopUp()
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

            $this->userController->topUp();

            $_POST['username'] = $user->username;
            $_POST['balance'] = 500000;
            $this->userController->postTopUp();

            $this->expectOutputRegex("[Location: /toko_online/public/users/dashboard]");

            $balance = $this->userRepository->checkBalance($user->username);
            self::assertEquals(0 + $_POST['balance'], $balance);
        }
        public function testProductDetail()
        {
            $product = new Product();
            $product->id = '12';
            $product->image = 'iPhone3g.jpg';
            $product->name = 'iPhone 3g';
            $product->category = 'iPhone';
            $product->price = 10000;
            $product->color = 'yellow';
            $product->stock = 13;
            $product->capacity = '128GB';
            $product->description = 'this is an iphone';
            $product->created_at = null;
            $product->modified_at = null;
            $this->userRepository->saveProduct($product);

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

            $_GET['id'] = $product->id;
            $this->userController->productDetail();

            $this->expectOutputRegex('[yellow]');
        }
        public function testAddToCart()
        {
            $product = new Product();
            $product->id = '12';
            $product->image = 'iPhone3g.jpg';
            $product->name = 'iPhone 3g';
            $product->category = 'iPhone';
            $product->price = 10000;
            $product->color = 'yellow';
            $product->stock = 13;
            $product->capacity = '128GB';
            $product->description = 'this is an iphone';
            $product->created_at = null;
            $product->modified_at = null;
            $this->userRepository->saveProduct($product);

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

            $_GET['id'] = $product->id;
            $this->userController->productDetail();

            $_POST['id'] = $product->id;
            $_POST['price'] = $product->price;
            $_POST['stock'] = $product->stock;
            $_POST['quantity'] = 3;
            $_POST['addToCart'] = 'true';
            $this->userController->postProductDetail();
            $this->expectOutputRegex("[Location: /toko_online/public/users/cart]");

            $this->userController->cart();
            $this->expectOutputRegex("[iPhone 3g]");
            $this->expectOutputRegex("[Price : 10000]");
        }
        public function testBuyNow()
        {
            $product = new Product();
            $product->id = '12';
            $product->image = 'iPhone3g.jpg';
            $product->name = 'iPhone 3g';
            $product->category = 'iPhone';
            $product->price = 10000;
            $product->color = 'yellow';
            $product->stock = 13;
            $product->capacity = '128GB';
            $product->description = 'this is an iphone';
            $product->created_at = null;
            $product->modified_at = null;
            $this->userRepository->saveProduct($product);

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

            $_POST['username'] = $user->username;
            $_POST['balance'] = 100000;
            $this->userController->postTopUp();

            $_GET['id'] = $product->id;
            $this->userController->productDetail();

            $_POST['id'] = $product->id;
            $_POST['price'] = $product->price;
            $_POST['stock'] = $product->stock;
            $quantity = $_POST['quantity'] = 3;
            $_POST['addToCart'] = null;
            $_POST['buyNow'] = 'true';
            $this->userController->postProductDetail();
            $this->expectOutputRegex("[Location: /toko_online/public/users/checkoutStatus]");
            $this->userController->checkoutStatus();
            $total = $product->price * $quantity;
            $this->expectOutputRegex("[$product->price]");
            $this->expectOutputRegex("[$total]");
        }
        public function testBuyNowFailed()
        {
            $product = new Product();
            $product->id = '12';
            $product->image = 'iPhone3g.jpg';
            $product->name = 'iPhone 3g';
            $product->category = 'iPhone';
            $product->price = 10000;
            $product->color = 'yellow';
            $product->stock = 0;
            $product->capacity = '128GB';
            $product->description = 'this is an iphone';
            $product->created_at = null;
            $product->modified_at = null;
            $this->userRepository->saveProduct($product);

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

            $_POST['username'] = $user->username;
            $_POST['balance'] = 100000;
            $this->userController->postTopUp();

            $_GET['id'] = $product->id;
            $this->userController->productDetail();

            $_POST['id'] = $product->id;
            $_POST['price'] = $product->price;
            $_POST['stock'] = $product->stock;
            $_POST['quantity'] = 3;
            $_POST['addToCart'] = null;
            $_POST['buyNow'] = 'true';
            $this->userController->postProductDetail();
            $this->expectOutputRegex("[quantity exceeds stock]");
        }  
    }
}
