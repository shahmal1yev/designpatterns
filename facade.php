<?php

interface Product
{
    // public function setAmount(int $amount): void;
    public function getAmount(): int;

    // public function setName(string $name): void;
    public function getName(): string;
}

class Phone implements Product
{
    private string $name;
    private int $amount;

    public function __construct(
        string $name,
        int $amount
    )
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}

class Computer implements Product
{
    private string $name;
    private int $amount;

    public function __construct(
        string $name,
        int $amount
    )
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}

class ShoppingCart {
    private array $cart = [];

    public function add(Product $product): void
    {
        $this->cart[] = $product;
    }

    public function getTotalPrice(): int
    {
        $total = 0;

        foreach($this->cart as $product)
        {
            $total += $product->getAmount();
        }

        return $total;
    }
}

class Payment
{
    public function complete(int $amount): void
    {
        echo "Payment process is being completed... $amount";
    }
}

class OrderFacade
{
    private ShoppingCart $shoppingCart;
    private Payment $payment;

    public function __construct(
        ShoppingCart $shoppingCart,
        Payment $payment
    )
    {
        $this->shoppingCart = $shoppingCart;
        $this->payment = $payment;
    }

    public function addToCart(Product $product): void
    {
        $this->shoppingCart->add($product);
    }

    public function checkout()
    {
        $totalPrice = $this->shoppingCart->getTotalPrice();
        return $this->payment->complete($totalPrice);
    }
}

$phone1 = new Phone("Samsung Galaxy A23", 500);
$phone2 = new Phone("Samsung Galaxy A50", 750);
$computer1 = new Computer("Intel Nuc M15", 2500);
$computer2 = new Computer("Acer Aspire", 600);

$orders = new OrderFacade(
    new ShoppingCart(),
    new Payment()
);

$orders->addToCart($phone1);
$orders->addToCart($phone2);
$orders->addToCart($computer1);
$orders->addToCart($computer2);

echo $orders->checkout();
