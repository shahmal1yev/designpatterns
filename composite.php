<?php

interface File
{
    public function getInfo(): void;
}

interface Folder
{
    public function add(File $file): void;
    public function remove(File $file): void;
}

class MixedFile implements File
{
    public function __construct(
        private string $name
    )
    {
    }

    public function getInfo(): void
    {
        echo "Name: $this->name\n";
        echo "-----------------\n\n";
    }
}

class Files implements Folder, File
{
    public function __construct(
        private $files = []
    )
    {
    }

    public function add(File $file): void
    {
        $this->files[] = $file;
    }

    public function remove(File $File): void
    {
        foreach($this->files as $index => $file)
        {
            if ($file === $File)
            {
                unset($this->files[$index]);
                break;
            }
        }
    }

    public function getInfo(): void
    {
        foreach($this->files as $file)
        {
            $file->getInfo();
        }
    }
}

$usersJsonFile = new MixedFile("users.json");
$articlesJsonFile = new MixedFile("articles.json");

$jsons = new Files();

$jsons->add($usersJsonFile);
$jsons->add($usersJsonFile);

$gameOfThronesPDF = new MixedFile("Game_of_Thrones.pdf");
$cplusplusbookPDF = new MixedFile("C_plus_plus.pdf");

$pdfs = new Files();

$pdfs->add($gameOfThronesPDF);
$pdfs->add($cplusplusbookPDF);

$files = new Files();

$files->add($jsons);
$files->add($pdfs);

$files->getInfo();