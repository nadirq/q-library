<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Implementation for FileInterface
 *
 * Trait FileTrait
 * @package App\Entity
 */
trait FileTrait
{
    public function getName()
    {
        return $this->name;
    }


    public function setName(string $name): FileInterface
    {
        $this->name= $name;

        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription(string $description): FileInterface
    {
        $this->description = $description;

        return $this;
    }


    public function getPhoto()
    {
        return $this->photo;
    }


    public function setPhoto(string $photo): FileInterface
    {
        $this->photo = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($photo));

        return $this;
    }


    public function getFile()
    {
        return $this->file;
    }

    public function setFile(string $file): FileInterface
    {
    }
}