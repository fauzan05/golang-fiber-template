<?php

namespace Fauzannurhidayat\Php\TokoOnline\Middleware {

    require_once __DIR__ . "/../Helper/Helper.php";

    use Fauzannurhidayat\Php\TokoOnline\Config\Database;
    use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
    use Fauzannurhidayat\Php\TokoOnline\Domain\User;
    use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
    use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
    use Fauzannurhidayat\Php\TokoOnline\Service\SessionService;
    use PHPUnit\Framework\TestCase;

    class MustLoginMiddlewareTest extends TestCase
    {
        private MustLoginMiddleware $mustLoginMiddleware;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        public function setUp(): void
        {
            $this->mustLoginMiddleware = new MustLoginMiddleware();
            putenv("mode=test");

            $this->userRepository = new UserRepository(Database::getConnection());
            $this->sessionRepository = new SessionRepository(Database::getConnection());

            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();
        }

        public function testBeforeGuest()
        {
            $this->mustLoginMiddleware->before();
            $this->expectOutputRegex("[Location: /PHP_MVC_LOGIN/public/users/login]");
        }

        public function testBeforeLoginUser()
        {
            $user = new User();
            $user->id = "14";
            $user->name = "Fauzan14";
            $user->password = "Fauzan14";
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->mustLoginMiddleware->before();
            $this->expectOutputString("");
        }
    }
}
