<?php

interface Command
{
    public function execute();
}

class Light
{
    public function turnOn()
    {
        return "light turn on";
    }

    public function turnOff()
    {
        return "light turn off";
    }
}

class LightTurnOn extends Light implements Command
{
    public function __construct(
        private Light $light
    )
    {
    }

    public function execute()
    {
        return $this->light->turnOn();
    }
}

class LightTurnOff extends Light implements Command
{
    public function __construct(
        private Light $light
    )
    {
    }

    public function execute()
    {
        return $this->light->turnOff();
    }
}

$light = new Light();
$turnOffLight = new LightTurnOff($light);

echo $turnOffLight->execute();