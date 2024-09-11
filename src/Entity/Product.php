<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $name = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 10)]
    private ?string $color = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToOne(mappedBy: 'product', cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    /**
     * @var Collection<int, Imagelist>
     */
    #[ORM\OneToMany(targetEntity: Imagelist::class, mappedBy: 'product')]
    private Collection $imagelists;

    public function __construct()
    {
        $this->imagelists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Imagelist>
     */
    public function getImagelists(): Collection
    {
        return $this->imagelists;
    }

    public function addImagelist(Imagelist $imagelist): static
    {
        if (!$this->imagelists->contains($imagelist)) {
            $this->imagelists->add($imagelist);
            $imagelist->setProduct($this);
        }

        return $this;
    }

    public function removeImagelist(Imagelist $imagelist): static
    {
        if ($this->imagelists->removeElement($imagelist)) {
            // set the owning side to null (unless already changed)
            if ($imagelist->getProduct() === $this) {
                $imagelist->setProduct(null);
            }
        }

        return $this;
    }
}
