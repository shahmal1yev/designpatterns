<?php

interface BashCommand
{
    public function execute(): string;
}

class Cat implements BashCommand
{
    public function execute(): string
    {
        return "cat";
    }
}

class FlagDecorator implements BashCommand
{
    private BashCommand $command;

    public function __construct(
        BashCommand $command
    )
    {
        $this->command = $command;
    }

    public function execute(): string
    {
        return $this->command->execute();
    }
}

class ShowAllDecorator extends FlagDecorator
{
    public function execute(): string
    {
        return parent::execute() . " --show-all";
    }
}

class ShowTabsDecorator extends FlagDecorator
{
    public function execute(): string
    {
        return parent::execute() . " --show-tabs";
    }
}

function clientCode(BashCommand $command)
{
    echo $command->execute() . "\n";
}

$cat = new Cat();
clientCode($cat);

$catShowAll = new ShowAllDecorator($cat);
clientCode($catShowAll);

$catShowAllShowTabs = new ShowTabsDecorator($catShowAll);
clientCode($catShowAllShowTabs);
