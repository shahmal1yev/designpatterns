<?php

interface CommandLineInterface
{
    public function ls(): array;
}

class Bash implements CommandLineInterface
{
    public function ls(): array
    {
        return [];
    }
}

class Terminal implements CommandLineInterface
{
    public function ls(): array
    {
        return [];
    }
}

class CMD
{
    public function dir(): array
    {
        return [];
    }
}

class CMDAdapter implements CommandLineInterface
{
    public function __construct(
        private CMD $cmd
    )
    {
    }

    public function ls(): array
    {
        return $this->cmd->dir();
    }
}

$linux = new Bash();
$macos = new Terminal();
$windows = new CMDAdapter(new CMD());
// $windows = new CMD();

print_r($linux->ls());
print_r($macos->ls());
print_r($windows->ls());