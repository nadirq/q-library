<?php
declare(strict_types=1);

namespace App\Entity;

/**
 * Interface FileInterface
 * @package App\Entity
 */
interface FileInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return FileInterface
     */
    public function setName(string $name): FileInterface;

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return FileInterface
     */
    public function setDescription(string $description): FileInterface;

    /**
     * @return string
     */
    public function getPhoto();

    /**
     * @param string $photo base64 encoded photo
     *
     * @return FileInterface
     */
    public function setPhoto(string $photo): FileInterface;

    /**
     * @return string
     */
    public function getFile();

    /**
     * @param string $file
     *
     * @return FileInterface
     */
    public function setFile(string $file): FileInterface;
}