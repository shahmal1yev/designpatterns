<?php

interface Character
{
    public function setName(string $name): void;
    public function getName(): string;
}

class Warrior implements Character
{
    private string $name;

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class Wizard implements Character
{
    private string $name;

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

interface CharacterFactory
{
    public static function create(): Character;
}

class WizardFactory implements CharacterFactory
{
    private function __construct()
    {

    }

    public static function create(): Character
    {
        return new Wizard();
    }
}

class WarriorFactory implements CharacterFactory
{
    private function __construct()
    {

    }

    public static function create(): Character
    {
        return new Warrior();
    }
}

$wizard = WizardFactory::create();
