<?php

namespace Fauzannurhidayat\PhpMvc\Login\App{

    function header(string $value)
    {
        echo $value;
    }
}


namespace Fauzannurhidayat\PhpMvc\Login\Controller{
use Fauzannurhidayat\PhpMvc\Login\Config\Database;
use Fauzannurhidayat\PhpMvc\Login\Domain\User;
use Fauzannurhidayat\PhpMvc\Login\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    private UserController $userController;
    private UserRepository $userRepository;
    protected function setUp():void
    {   
        $this->userController = new UserController();
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
        $_POST['id'] = "Fauzan1";
        $_POST['name'] = "Fauzan1";
        $_POST['password'] = "Fauzan1";

        $this->userController->postRegister();
        //$this->expectOutputString("");
        $this->expectOutputRegex('[Location: users/login]');
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
        // $user = new User();
        // $user->id = "fauzan";
        // $user->name = "fauzan";
        // $user->password = "fauzan";

        //$this->userRepository->save($user);

        $_POST['id'] = "fauzan";
        $_POST['name'] = "fauzan";
        $_POST['password'] = "fauzan";

        $this->userController->postRegister();
        $this->expectOutputRegex("[User already exist]");
        //$this->expectOutputRegex("[Location: users/login]");
        //$this->expectOutputRegex("[Register]");
    }  
}   
}
