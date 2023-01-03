<?php

namespace Fauzannurhidayat\Php\TokoOnline\Service;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->id = "14";
        $user->name = "fauzan14";
        $user->password = "fauzan14";
        $this->userRepository->save($user);
    }

    public function testCreate()
    {
        $session = $this->sessionService->create("14");
        $this->expectOutputRegex("[FZN : $session->id]");

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals("14", $result->userId);
    }
    public function testDestroy()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "14";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->sessionService->destroy();

        $this->expectOutputRegex("[FZN : ]");

        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }
    public function testCurrent()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "14";

        $this->sessionRepository->save($session);
        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $user = $this->sessionService->current();
        self::assertEquals($session->userId, $user->id);
    }
}
