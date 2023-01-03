<?php

namespace Fauzannurhidayat\Php\TokoOnline\Service;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
use Fauzannurhidayat\Php\TokoOnline\Model\UserLoginRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserLoginResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserPasswordUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserPasswordUpdateResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserProfileUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserProfileUpdateResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserRegisterRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserRegisterResponse;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use PhpParser\Node\Stmt\TryCatch;

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
                throw new ValidationException("Id already exist");
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
    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);
        $user = $this->userRepository->findById($request->id);
        if ($user == null) {
            throw new ValidationException("Id or password is wrong");
            /*
            meskipun username tidak ada di database, kita tidak direkomendasikan 
            memberi tahu user bahwa user id tidak ada di database
            */
        }
        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Id or password is wrong");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if (
            $request->id == null || $request->password == null ||
            trim($request->id) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Name, Password cannot blank");
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserUpdateProfileRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User Not Found!");
            }

            $user->name = $request->name;
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;

        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserUpdateProfileRequest(UserProfileUpdateRequest $request)
    {
        if (
            $request->id == null || $request->name == null ||
            trim($request->id) == "" || trim($request->name) == ""
        ) {
            throw new ValidationException("Name cannot blank");
        }
    }

    public function updatePassword(UserPasswordUpdateRequest $request):UserPasswordUpdateResponse
    {
        $this->validateUserUpdatePasswordRequest($request);
        
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);

            if($user == null)
            {
                throw new ValidationException("User is not found");
            }

            if(!password_verify($request->oldPassword, $user->password))
            {
                throw new ValidationException("Old password is wrong!");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserPasswordUpdateResponse();
            $response->user = $user;

            return $response;

        } catch (ValidationException $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function validateUserUpdatePasswordRequest(UserPasswordUpdateRequest $request)
    {
        if (
            $request->id == null || $request->oldPassword == null || $request->newPassword == null ||
            trim($request->id) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == ""
        ) {
            throw new ValidationException("Old Password, New Password cannot blank");
        }
    }
}
