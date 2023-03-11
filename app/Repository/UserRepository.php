<?php

namespace Fauzannurhidayat\Php\TokoOnline\Repository;

use Fauzannurhidayat\Php\TokoOnline\Domain\Cart;
use Fauzannurhidayat\Php\TokoOnline\Domain\CartItem;
use Fauzannurhidayat\Php\TokoOnline\Domain\Product;
use Fauzannurhidayat\Php\TokoOnline\Domain\User;
use Fauzannurhidayat\Php\TokoOnline\Domain\ShoppingSession;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(id,firstname,lastname,username,email,image,password,date_of_birth,gender,phone_number,address,jobs,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(
            [
                $user->id,
                $user->firstname,
                $user->lastname,
                $user->username,
                $user->email,
                $user->image,
                $user->password,
                $user->dateOfBirth,
                $user->gender,
                $user->phoneNumber,
                $user->address,
                $user->jobs,
                $user->status
            ]
        );
        return $user;
    }
    public function saveProduct(Product $products): Product
    {
        $statement = $this->connection->prepare("INSERT INTO products(id,name,category,price,color,capacity,description,image,stock,created_at, modified_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(
            [
                $products->id,
                $products->name,
                $products->category,
                $products->price,
                $products->color,
                $products->capacity,
                $products->description,
                $products->image,
                $products->stock,
                $products->created_at,
                $products->modified_at
            ]
        );
        return $products;
    }
    public function editProduct(Product $products): Product
    {
        $statement = $this->connection->prepare("UPDATE products SET name = ?,category = ?, price = ?, color = ?, capacity = ?, description = ?, image = ?, stock = ? WHERE id = ?");
        $statement->execute(
            [
                $products->name,
                $products->category,
                $products->price,
                $products->color,
                $products->capacity,
                $products->description,
                $products->image,
                $products->stock,
                $products->id
            ]
        );
        return $products;
    }
    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET firstname = ?, lastname  = ?, email = ?, gender = ?, phone_number = ?, jobs = ?, date_of_birth = ?, address = ? WHERE username = ?");
        $statement->execute([
            $user->firstname, $user->lastname, $user->email, $user->gender, $user->phoneNumber, $user->jobs, $user->dateOfBirth, $user->address, $user->username
        ]);
        return $user;
    }
    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->firstname = $row['firstname'];
                $user->lastname = $row['lastname'];
                $user->email = $row['email'];
                $user->gender = $row['gender'];
                $user->phoneNumber = $row['phone_number'];
                $user->address = $row['address'];
                $user->jobs = $row['jobs'];
                $user->dateOfBirth = $row['date_of_birth'];
                $user->created_at = $row['created_at'];
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->status = $row['status'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function findByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("SELECT id, email, password, status FROM users WHERE email = ?");
        $statement->execute([$email]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->status = $row['status'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->firstname = $row['firstname'];
                $user->lastname = $row['lastname'];
                $user->email = $row['email'];
                $user->gender = $row['gender'];
                $user->phoneNumber = $row['phone_number'];
                $user->address = $row['address'];
                $user->jobs = $row['jobs'];
                $user->dateOfBirth = $row['date_of_birth'];
                $user->created_at = $row['created_at'];
                $user->password = $row['password'];
                $user->status = $row['status'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM users");
    }
    public function deleteAllProduct(): void
    {
        $this->connection->exec("DELETE FROM products");
    }
    public function findProductsById(string $id): ?Product
    {
        $statement = $this->connection->prepare("SELECT id, name, image, stock, color, capacity, description, category, price, created_at, modified_at FROM products WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $product = new Product();
                $product->id = $row['id'];
                $product->name = $row['name'];
                $product->image = $row['image'];
                $product->stock = $row['stock'];
                $product->color = $row['color'];
                $product->capacity = $row['capacity'];
                $product->description = $row['description'];
                $product->category = $row['category'];
                $product->price = $row['price'];
                $product->created_at = $row['created_at'];
                $product->modified_at = $row['modified_at'];
                return $product;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function showProductByCategory(string $category): ?array
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE category = ?");
        $statement->execute([$category]);

        try {
            $produkArray = [];
            if ($rows = $statement->fetchAll()) {
                foreach ($rows as $row) :
                    $produk = new Product();
                    $produk->id = $row['id'];
                    $produk->name = $row['name'];
                    $produk->category = $row['category'];
                    $produk->price = $row['price'];
                    $produk->color = $row['color'];
                    $produk->capacity = $row['capacity'];
                    $produk->image = $row['image'];
                    array_push($produkArray, $produk);
                endforeach;
                return $produkArray;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function showAllProduct(): ?array
    {
        $statement = $this->connection->prepare("SELECT id, name, category, price, color, capacity, image FROM products");
        $statement->execute();
        try {
            $produkArray = [];
            if ($rows = $statement->fetchAll()) {
                foreach ($rows as $row) :
                    $produk = new Product();
                    $produk->id = $row['id'];
                    $produk->name = $row['name'];
                    $produk->category = $row['category'];
                    $produk->price = $row['price'];
                    $produk->color = $row['color'];
                    $produk->capacity = $row['capacity'];
                    $produk->image = $row['image'];
                    array_push($produkArray, $produk);
                endforeach;
                return $produkArray;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function showAllUser(): ?array
    {
        $statement = $this->connection->prepare("SELECT id, username, email, status, gender FROM users WHERE status = 'user' ");
        $statement->execute();
        try {
            $userArray = [];
            if ($rows = $statement->fetchAll()) {
                foreach ($rows as $row) :
                    $user = new User();
                    $user->id = $row['id'];
                    $user->username = $row['username'];
                    $user->email = $row['email'];
                    $user->status = $row['status'];
                    $user->gender = $row['gender'];
                    array_push($userArray, $user);
                endforeach;
                return $userArray;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function deleteProductById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM products WHERE id = ?");
        $statement->execute([$id]);
        $statement->closeCursor();
    }
    public function deleteUserById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        $statement->execute([$id]);
        $statement->closeCursor();
    }
    public function countAllProduct(): ?string
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) FROM products");
        $statement->execute();
        try {
            if ($row = $statement->fetchColumn()) {
                $total = $row;
                return $total;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function countAllUsers(): ?string
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) FROM users WHERE status = 'user'");
        $statement->execute();
        try {
            if ($row = $statement->fetchColumn()) {
                $total = $row;
                return $total;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function saveToCart(Cart $cart): Cart
    {
        $statement = $this->connection->prepare("INSERT INTO shopping_session(user_id, total) VALUES(?,?)");
        $statement->execute(
            [
                $cart->userId,
                $cart->total
            ]
        );
        $statement = $this->connection->prepare("SELECT id FROM shopping_session WHERE user_id = ? ORDER BY id DESC LIMIT 1");
        $statement->execute([$cart->userId]);
        try {
            if ($row = $statement->fetch()) {

                $cart->sessionId = $row['id'];
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }

        $statement = $this->connection->prepare("INSERT INTO cart_item(session_id, product_id, quantity) VALUES(?,?,?)");
        $statement->execute(
            [
                $cart->sessionId,
                $cart->productId,
                $cart->quantity
            ]
        );

        return $cart;
    }
    public function showAllCart($id): array
    {
        $statement = $this->connection->prepare("
        SELECT products.id, products.name, products.category, products.color, products.image, products.capacity,
        products.price, cart_item.id as cart_item_id, cart_item.quantity, cart_item.created_at, shopping_session.user_id from products 
        INNER JOIN cart_item ON cart_item.product_id = products.id
        INNER JOIN shopping_session ON shopping_session.id = cart_item.session_id
        WHERE shopping_session.user_id = ?
        ");
        $statement->execute([$id]);
        try {
            $array = [];
            if ($rows = $statement->fetchAll()) {
                foreach ($rows as $row) {
                    $product = new Product();
                    $product->id = $row['id'];
                    $product->name = $row['name'];
                    $product->category = $row['category'];
                    $product->color = $row['color'];
                    $product->image = $row['image'];
                    $product->capacity = $row['capacity'];
                    $product->price = $row['price'];
                    $cart = new Cart();
                    $cart->id = $row['cart_item_id'];
                    $cart->quantity = $row['quantity'];
                    $cart->createdAt = $row['created_at'];
                    $array[] = [
                        'product' => $product,
                        'cart' => $cart
                    ];
                }
                return $array;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}
