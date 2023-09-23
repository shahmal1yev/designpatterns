<?php

interface Observer
{
    public function update(string $message): void;
}

interface UserInterface
{
    public function setName(string $name): void;
    public function getName(): string;
}

interface Observerable
{
    public function registerObserver(Observer $observer): void;
    public function removeObserver(Observer $observer): void;
}

class User implements UserInterface, Observer
{
    public function __construct(
        private $name
    )
    {
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function update(string $message): void
    {
        echo $message;
    }
}

interface ProductInterface
{
    public function setName(string $name): void;
    public function getName(): string;
    public function setAmount(float $amount): void;
    public function getAmount(): float;
}

class Product implements ProductInterface, Observerable
{
    public function __construct(
        private string $name,
        private float $amount,
        private array $observers = []
    )
    {
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->notifyObservers();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
        $this->notifyObservers();
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function registerObserver(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $wanted): void
    {
        foreach($this->observers as $index => $observer)
        {
            if ($observer === $wanted)
            {
                unset($this->observers[$index]);
                break;
            }
        }
    }

    public function notifyObservers()
    {
        foreach($this->observers as $observer)
        {
            $observer->update("{$observer->getName()} - Yenilənmə var\n");
        }
    }
}

$user1 = new User("Eldar");
$user2 = new User("Cavad");

$product = new Product("Phone", 700);

$product->registerObserver($user1);
$product->registerObserver($user2);

$product->setName("Computer");
$product->setAmount(800);
$product->setAmount(800);
$product->setAmount(800);
$product->setAmount(800);