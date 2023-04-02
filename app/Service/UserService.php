<?php

namespace Fauzannurhidayat\Php\TokoOnline\Service;

use Fauzannurhidayat\Php\TokoOnline\Config\Database;
use Fauzannurhidayat\Php\TokoOnline\Domain\Cart;
use Fauzannurhidayat\Php\TokoOnline\Domain\CartItem;
use Fauzannurhidayat\Php\TokoOnline\Domain\Order;
use Fauzannurhidayat\Php\TokoOnline\Domain\Product;
use Fauzannurhidayat\Php\TokoOnline\Domain\ShoppingSession;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Exception\ValidationException;
use Fauzannurhidayat\Php\TokoOnline\Model\AddProductRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\AddProductResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\AddToCartRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\AddToCartResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\AdminLoginRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\AdminLoginResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\BuyNowRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\BuyNowResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\EditProductRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\EditProductResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\ShoppingSessionRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\ShoppingSessionResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\TopUpRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\TopUpResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserLoginRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserLoginResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserPasswordUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserPasswordUpdateResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserProfileUpdateRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserProfileUpdateResponse;
use Fauzannurhidayat\Php\TokoOnline\Model\UserRegisterRequest;
use Fauzannurhidayat\Php\TokoOnline\Model\UserRegisterResponse;
use Fauzannurhidayat\Php\TokoOnline\Repository\UserRepository;
use PhpParser\Node\Expr\Isset_;
use PHPUnit\Util\Xml\ValidationResult;
use PHPUnit\Util\Xml\Validator;

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
            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("Username is already exist");
            }
            //jika user tidak ada di dalam database maka akan melakukan aksi dibawah ini
            $user = new User();
            $user->id = $request->id;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $user->dateOfBirth = $request->dateOfBirth;
            $user->gender = $request->gender;
            $user->phoneNumber = $request->phoneNumber;
            $user->address = $request->address;
            $user->jobs = $request->jobs;
            $user->image = $request->image;
            $user->status = $request->status;
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
            $request->username == null || $request->firstname == null || $request->lastname == null
            || $request->email == null || $request->dateOfBirth == null || $request->gender == null
            || $request->phoneNumber == null || $request->address == null|| $request->password == null || $request->jobs == null ||
            trim($request->username) == "" || trim($request->firstname) == "" || trim($request->password) == ""
            || trim($request->lastname) == "" || trim($request->email) == "" || trim($request->dateOfBirth) == ""
            || trim($request->gender) == "" || trim($request->phoneNumber) == "" || trim($request->address) == ""
            || trim($request->jobs) == ""
        ) {
            throw new ValidationException("Either of these forms cannot be empty");
        }
    }
    public function loginUser(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);
        $email = $this->userRepository->findByEmail($request->email);

        if ($email == null) {
            throw new ValidationException("Email or password is wrong");
            /*
            meskipun username tidak ada di database, kita tidak direkomendasikan 
            memberi tahu user bahwa username tidak ada di database
            */
        }
        if (password_verify($request->password, $email->password)) {
            $response = new UserLoginResponse();
            $response->user = $email;
            return $response;
        } else {
            throw new ValidationException("Email or password is wrong");
        }
    }
    public function loginAdmin(AdminLoginRequest $request): AdminLoginResponse
    {
        $this->validateAdminLoginRequest($request);
        $username = $this->userRepository->findByUsername($request->username);

        if ($username == null) {
            throw new ValidationException("Username or password is wrong");
            /*
            meskipun username tidak ada di database, kita tidak direkomendasikan 
            memberi tahu user bahwa username tidak ada di database
            */
        }
        if (password_verify($request->password, $username->password)) {
            $response = new AdminLoginResponse();
            $response->user = $username;
            return $response;
        } else {
            throw new ValidationException("Username or password is wrong");
        }
    }
    private function validateAdminLoginRequest(AdminLoginRequest $request)
    {
        if (
            $request->username == null || $request->password == null ||
            trim($request->username) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Username or Password cannot empty");
        }
    }
    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if (
            $request->email == null || $request->password == null ||
            trim($request->email) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Email or Password cannot empty");
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserUpdateProfileRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user == null) {
                throw new ValidationException("User Not Found!");
            }
            $user = new User();
            $user->username = $request->username;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->phoneNumber = $request->phoneNumber;
            $user->jobs = $request->jobs;
            $user->dateOfBirth = $request->dateOfBirth;
            $user->address = $request->address;
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
            $request->firstname == null || $request->lastname == null 
            || $request->dateOfBirth == null || $request->gender == null || $request->phoneNumber == null
            || $request->address == null || $request->jobs == null ||
            trim($request->firstname) == "" || trim($request->lastname) == ""
            || trim($request->dateOfBirth) == "" || trim($request->gender) == "" || trim($request->phoneNumber) == ""
            || trim($request->address) == "" || trim($request->jobs) == ""
         ) {
            throw new ValidationException("Either of these forms cannot be empty");
        }
    }

    public function updatePassword(UserPasswordUpdateRequest $request): UserPasswordUpdateResponse
    {
        $this->validateUserUpdatePasswordRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByUsername($request->username);

            if ($user == null) {
                throw new ValidationException("Username is not found");
            }

            if (!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Old password is wrong!");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->updatePassword($user);

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
            $request->username == null || $request->oldPassword == null || $request->newPassword == null ||
            trim($request->username) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == ""
        ) {
            throw new ValidationException("Old Password, New Password cannot empty");
        }
    }

    public function addProduct(addProductRequest $addProductRequest): addProductResponse
    {
        $this->validateAddProductRequest($addProductRequest);

        try {
            Database::beginTransaction();
            $product = new Product();
            $product->image = $this->validateAddImageRequest($addProductRequest);
            $product->id = $addProductRequest->id;
            $product->name = $addProductRequest->name;
            $product->description = $addProductRequest->description;
            $product->category = $addProductRequest->category;
            $product->price = $addProductRequest->price;
            $product->color = $addProductRequest->color;
            $product->stock = $addProductRequest->stock;
            $product->capacity = $addProductRequest->capacity;
            $product->created_at = $addProductRequest->created_at;
            $product->modified_at = $addProductRequest->modified_at;
            $this->userRepository->saveProduct($product);
            
            $response = new addProductResponse();
            $response->product = $product;
            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateAddImageRequest(AddProductRequest $addProductRequest)
    { 
        $file = $addProductRequest->image;
        $locationImage = "/Applications/XAMPP/xamppfiles/htdocs/toko_online/public/assets/images/products/";
        if(empty($file['name']))
        {
            throw new ValidationException('No Images was selected for upload');
        }

        $formatImageValid = ['jpg','jpeg','png'];
        $formatImage = explode('.', $file['name']);
        $formatImage = strtolower(end($formatImage));
        $file['name'] = uniqid();
        $newFileName = $file['name'] . '.' . $formatImage;

        if(!in_array($formatImage, $formatImageValid))
        {
            throw new ValidationException('Please enter the image format (jpg,jpeg,png)');
        }
        if($file['size'] > 1000000)
        {
            throw new ValidationException('the image size exceeds the limit');
        }
        if(!move_uploaded_file($file['tmp_name'], $locationImage . $newFileName))
        {
            throw new ValidationException('this image fail to upload');
        }
        return $newFileName;  
    }
    private function validateAddProductRequest(addProductRequest $addProductRequest)
    {
        if (
            $addProductRequest->name == null || $addProductRequest->description == null || $addProductRequest->category == null 
            || $addProductRequest->price == null || $addProductRequest->color == null || $addProductRequest->capacity == null ||
            trim($addProductRequest->name) == "" || trim($addProductRequest->description) == "" || trim($addProductRequest->category) == ""
            || trim($addProductRequest->price) == "" || trim($addProductRequest->color) == "" || trim($addProductRequest->capacity) == ""
        ) {
            throw new ValidationException("this form don't blank");
        }
    }
    public function editProduct(EditProductRequest $editProductRequest): EditProductResponse
    {
        $this->validateEditProductRequest($editProductRequest);
        try {
            Database::beginTransaction();
                $product = new Product();
                $product->id = $editProductRequest->id;
                $product->image = $this->validateEditImageRequest($editProductRequest);
                $product->name = $editProductRequest->name;
                $product->category = $editProductRequest->category;
                $product->price = $editProductRequest->price;
                $product->stock = $editProductRequest->stock;
                $product->color = $editProductRequest->color;
                $product->capacity = $editProductRequest->capacity;
                $product->description = $editProductRequest->description;
                $this->userRepository->editProduct($product);
                $response = new EditProductResponse();
                $response->product = $product;
            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateEditImageRequest(EditProductRequest $editProductRequest)
    {
        $file = $editProductRequest->image;
        if(!isset($file['name']) || $file['name'] == null || $file['name'] == "")
        {
            return $this->userRepository->findProductsById($editProductRequest->id)->image;
        }
        $locationImage = "/Applications/XAMPP/xamppfiles/htdocs/toko_online/public/assets/images/products/";
        $formatImageValid = ['jpg','jpeg','png'];
        $formatImage = explode('.', $file['name']);
        $formatImage = strtolower(end($formatImage));
        $file['name'] = uniqid();
        $newFileName = $file['name'] . '.' . $formatImage;

        if(!in_array($formatImage, $formatImageValid))
        {
            throw new ValidationException('Please enter the image format (jpg,jpeg,png)');
        }
        if($file['size'] > 1000000)
        {
            throw new ValidationException('the image size exceeds the limit');
        }
        if(!move_uploaded_file($file['tmp_name'], $locationImage . $newFileName))
        {
            throw new ValidationException('this image fail to upload');
        }
        return $newFileName;
        
    }
    private function validateEditProductRequest(EditProductRequest $editProductRequest)
    {
        if (
            $editProductRequest->name == null || $editProductRequest->description == null || $editProductRequest->category == null || $editProductRequest->price == null ||
            trim($editProductRequest->name) == "" || trim($editProductRequest->description) == "" || trim($editProductRequest->category) == "" || trim($editProductRequest->price) == ""
        ) {
            throw new ValidationException("this form don't blank");
        }
    }
    public function addToCart(AddToCartRequest $request):AddToCartResponse
    {
        $this->validateAddToCartRequest($request);
        if($request->quantity <= 0){
            throw new ValidationException('Quantity is not lower than 0');
        }
        if($request->stock - $request->quantity <= 0){
            throw new ValidationException('The product has out of stock');
        }
        try {
            Database::beginTransaction();
            $cart = new Cart();
            $cart->id = $request->id;
            $cart->userId = $request->userId;
            $cart->total = $request->price * $request->quantity;
            $cart->productId = $request->productId;
            $cart->quantity = $request->quantity;
            $this->userRepository->saveToCart($cart);
            $response = new AddToCartResponse();
            $response->cart = $cart;
            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateAddToCartRequest(AddToCartRequest $addToCartRequest)
    {
        if(
            $addToCartRequest->quantity == null || trim($addToCartRequest->quantity) == ""
        ){
            throw new ValidationException('Quantity form is doesnt empty');
        }
    }
    public function transaction(BuyNowRequest $request):BuyNowResponse
    {
        $this->validateTransactionRequest($request);
        if($request->total <= 0)
        {
            throw new ValidationException('Quantity is not lower than 0');
        }
        if($request->balanceUser < $request->total * $request->price)
        {
            throw new ValidationException('Your balance isnt enough');
        }
        if($request->stock - $request->total < 0)
        {
            throw new ValidationException('quantity exceeds stock');
        }
        try{
            Database::beginTransaction();
            $buyNow = new Order();
            $buyNow->userId = $request->userId;
            $buyNow->total = $request->total;
            $buyNow->amount = $request->price * $buyNow->total;
            $buyNow->productId = $request->productId;
            $this->userRepository->buyNow($buyNow);
            $response = new BuyNowResponse();
            $response->order = $buyNow;
            Database::commitTransaction();
            return $response;

        }catch(\Exception $exception)
        {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateTransactionRequest(BuyNowRequest $request)
    {
        if($request->total == null || trim($request->total) == "" || empty($request->total))
        {
            throw new ValidationException('Quantity form is doesnt empty');
        }
    }
    public function topUpService(TopUpRequest $request):TopUpResponse
    {
        $this->validateTopUpService($request);
        try{
            Database::beginTransaction();
            $balanceNow = $this->userRepository->checkBalance($request->username);
            $user = new User();
            $user->username = $request->username;
            $user->balance = $balanceNow + $request->balance;
            $this->userRepository->topUp($user);
            $response = new TopUpResponse();
            $response->user = $user;
            Database::commitTransaction();
            return $response;
        }catch(\Exception $exception)
        {
            Database::rollbackTransaction();
            throw $exception;
        }        
    }
    private function validateTopUpService(TopUpRequest $request)
    {
        if($request->username == null || trim($request->username) == "" || empty($request->username))
        {
            throw new ValidationException('This form must be filled !');
        }
    }
}
