<?php

use ShoppingCart as GlobalShoppingCart;

interface WeightInterface
{
    public function setWeight(float $weight): void;
    public function getWeight(): float;
}

interface ProductInterface
{
    public function setAmount(int $amount): void;
    public function getAmount(): float;

    public function setName(string $name): void;
    public function getName(): string;
}

class Phone implements ProductInterface, WeightInterface
{
    public function __construct(
        private string $name,
        private int $amount,
        private float $weight
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

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}

interface CargoCompanyInterface
{
    public function getName(): string;
    public function getInterest(): float;
}

class FedEx implements CargoCompanyInterface
{
    public function __construct(
        private string $name = "FedEx",
        private float $interest = 0.7
    )
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInterest(): float
    {
        return $this->interest;
    }
}

class ArasKargo implements CargoCompanyInterface
{
    public function __construct(
        private string $name = 'ArasKargo',
        private float $interest = 0.5
    )
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInterest(): float
    {
        return $this->interest;
    }
}

class ShoppingCart implements WeightInterface
{
    public function __construct(
        private array $products = [],
        private int $weight = 0
    )
    {
    }

    public function getTotalAmount(): float
    {
        $total = 0;
        foreach($this->products as $product)
        {
            $total += $product->getAmount();
        }

        return $total;
    }

    public function add(ProductInterface $product): void
    {
        $this->products[] = $product;
    }

    public function getWeight(): float
    {
        $weight = 0;
        foreach($this->products as $product)
        {
            $weight += $product->getWeight();
        }

        return $weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }
}

class Payment
{
    public function complete(float $amount): void
    {
        echo "Completing...: $amount";
    }
}

interface OrderFacadeInterface
{
    public function addToCart(Product $product): void;
    public function checkout(): void;
}

interface CargoStrategy
{
    public function setShippingStrategy(CargoCompanyInterface $cargoComp): void;
    public function getShippingStrategy(): CargoCompanyInterface;
}

class OrderFacade implements CargoStrategy
{
    public function __construct(
        private ShoppingCart $shoppingCart,
        private Payment $payment,
        private CargoCompanyInterface $cargoComp
    )
    {
    }

    public function addToCart(ProductInterface $product): void
    {
        $this->shoppingCart->add($product);
    }

    public function getTotalAmount(): float
    {
        $cartTotalWeight = $this->shoppingCart->getWeight();
        $shoppingCost = $this->cargoComp->getInterest() * $cartTotalWeight;
        $cartTotalAmount = $this->shoppingCart->getTotalAmount();
        $totalFee = $cartTotalAmount + $shoppingCost;

        return $totalFee;
    }

    public function checkout(): void
    {
        $totalAmount = $this->getTotalAmount();
        $this->payment->complete($totalAmount);
    }

    public function setShippingStrategy(CargoCompanyInterface $cargoComp): void
    {
        $this->cargoComp = $cargoComp;
    }

    public function getShippingStrategy(): CargoCompanyInterface
    {
        return $this->cargoComp;
    }
}

$phone = new Phone("Samsung Galaxy A52", 500, 0.9);

$payment = new Payment();

$fedex = new FedEx();
$arasKargo = new ArasKargo('ArasKargo', 39.00);

$shoppingCart = new GlobalShoppingCart();

$orderFacade = new OrderFacade(
    $shoppingCart,
    $payment,
    $fedex
);

$orderFacade->addToCart($phone);
$orderFacade->setShippingStrategy($arasKargo);
echo $orderFacade->getTotalAmount();