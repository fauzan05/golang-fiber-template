<?php

namespace Fauzannurhidayat\Php\TokoOnline\Repository;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

    public function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }
    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = 'fauzan';
        $user->name = 'fauzan';
        $user->password = 'fauzan';

        $this->userRepository->save($user);
        $result = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
        $user = $this->userRepository->findById('123');
        self::assertNull($user);
        //self::assertNotNull($user);
    }

    public function testUpdate()
    {
        $user = new User();
        $user->id = '14';
        $user->name = 'fauzan14';
        $user->password = 'fauzan14';
        $this->userRepository->save($user);

        $user->name = "yaya";
        $this->userRepository->update($user);

        $result = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);
    }
}
