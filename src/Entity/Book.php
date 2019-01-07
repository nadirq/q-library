<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 *
 * @package App\Entity
 */
class Book implements FileInterface
{
    use FileTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     *  @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     *  @ORM\Column(name="photo", type="text", nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(name="file", type="binary", nullable=true)
     */
    private $file;
}