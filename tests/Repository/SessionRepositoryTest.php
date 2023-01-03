<?php

namespace Fauzannurhidayat\Php\TokoOnline\Repository;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use PHPUnit\Framework\TestCase;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->id = "14";
        $user->name = "fauzan14";
        $user->password = "fauzan14";
        $this->userRepository->save($user);
    }

    public function testSaveSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "14";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
    }

    public function testDeleteByIdSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "14";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);

        $this->sessionRepository->deleteById($session->id);
        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }

    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById('not found');
        self::assertNull($result);
    }
}
