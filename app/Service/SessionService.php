<?php

namespace Fauzannurhidayat\Php\TokoOnline\Service;

use Fauzannurhidayat\Php\TokoOnline\Domain\Session;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Repository\SessionRepository;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;

class SessionService
{
    public static string $COOKIE_NAME = "Cookie";
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }
    public function createByEmail (string $email): Session
    {
        $user = $this->userRepository->findByEmail($email);
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;

        $this->sessionRepository->save($session);
        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");

        return $session;
    }
    public function createByUsername (string $username): Session
    {
        $user = $this->userRepository->findByUsername($username);
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;

        $this->sessionRepository->save($session);
        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");

        return $session;
    }
    public function destroy()
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME];
        $this->sessionRepository->deleteById($sessionId);
        setcookie(self::$COOKIE_NAME, '', 1, "/");
    }

    public function current():?User
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if($session == null)
        {
            return null;
        }
        return $this->userRepository->findById($session->userId);
    }
}