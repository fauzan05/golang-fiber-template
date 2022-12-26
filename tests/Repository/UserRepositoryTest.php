<?php

namespace Fauzannurhidayat\PhpMvc\Login\Repository;

use Fauzannurhidayat\PhpMvc\Login\Config\Database;
use Fauzannurhidayat\PhpMvc\Login\Domain\User;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    public function setUp():void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        //$this->userRepository->deleteAll();
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

}