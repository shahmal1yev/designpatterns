<?php

class Computer
{
    public function __construct(
        private string $name,
        private float $cpu,
        private float $ram,
        private float $videoCard,
        private string $networkCard
    )
    {
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of cpu
     */ 
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * Set the value of cpu
     *
     * @return  self
     */ 
    public function setCpu($cpu)
    {
        $this->cpu = $cpu;

        return $this;
    }

    /**
     * Get the value of ram
     */ 
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * Set the value of ram
     *
     * @return  self
     */ 
    public function setRam($ram)
    {
        $this->ram = $ram;

        return $this;
    }

    /**
     * Get the value of videoCard
     */ 
    public function getVideoCard()
    {
        return $this->videoCard;
    }

    /**
     * Set the value of videoCard
     *
     * @return  self
     */ 
    public function setVideoCard($videoCard)
    {
        $this->videoCard = $videoCard;

        return $this;
    }

    /**
     * Get the value of networkCard
     */ 
    public function getNetworkCard()
    {
        return $this->networkCard;
    }

    /**
     * Set the value of networkCard
     *
     * @return  self
     */ 
    public function setNetworkCard($networkCard)
    {
        $this->networkCard = $networkCard;

        return $this;
    }
}

interface ComputerBuilderInterface
{
    public function buildName(string $name): void;
    public function buildCpu(float $cpu): void;
    public function buildRam(float $ram): void;
    public function buildVideoCard(float $videoCard): void;
    public function buildNetworkCard(string $networkCard): void;
}

class ComputerBuilder # implements ComputerBuilderInterface
{
    public function __construct(
        private Computer $computer
    )
    {
    }
}

$computer = new Computer(
    "Intel NUC M15",
    2.1,
    16,
    00,
    ""
);

new ComputerBuilder($computer);