<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="test")
     */
    private $blogposts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="category")
     */
    private $blogPosts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBlogposts(): ?BlogPost
    {
        return $this->blogposts;
    }

    public function setBlogposts(?BlogPost $blogposts): self
    {
        $this->blogposts = $blogposts;

        return $this;
    }
}
