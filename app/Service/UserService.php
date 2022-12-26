<?php

namespace Fauzannurhidayat\PhpMvc\Login\Service;

use Fauzannurhidayat\PhpMvc\Login\Config\Database;
use Fauzannurhidayat\PhpMvc\Login\Domain\User;
use Fauzannurhidayat\PhpMvc\Login\Exception\ValidationException;
use Fauzannurhidayat\PhpMvc\Login\Model\UserLoginRequest;
use Fauzannurhidayat\PhpMvc\Login\Model\UserLoginResponse;
use Fauzannurhidayat\PhpMvc\Login\Model\UserRegisterRequest;
use Fauzannurhidayat\PhpMvc\Login\Model\UserRegisterResponse;
use Fauzannurhidayat\PhpMvc\Login\Repository\UserRepository;

//use function PHPUnit\Framework\throwException;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if ($user != null) {
                throw new ValidationException("User already exist");
            }
            //jika user tidak ada di dalam database maka akan melakukan aksi dibawah ini
            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;
            Database::commitTransaction();
            return $response;

        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if (
            $request->id == null || $request->name == null || $request->password == null ||
            trim($request->id) == "" || trim($request->name) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Name, Password cannot blank");
        }
    }
    public function login(UserLoginRequest $request):UserLoginResponse
    {
        $this->validateUserLoginRequest($request);
        $user = $this->userRepository->findById($request->id);
        if($user == null)
        {
            throw new ValidationException("Id or password is wrong");
            /*
            meskipun username tidak ada di database, kita tidak direkomendasikan 
            memberi tahu user bahwa user id tidak ada di database
            */
        }
        if(password_verify($request->password, $user->password))
        {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new ValidationException("Id or password is wrong");
        }

    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if(
            $request->id == null || $request->password == null ||
            trim($request->id) == "" || trim($request->password) == ""
        ){
            throw new ValidationException("Id, Name, Password cannot blank");
        }
    }
}
