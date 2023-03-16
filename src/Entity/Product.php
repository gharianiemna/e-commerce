<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"products"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"products"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"products"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"products"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"products"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"products"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="product")
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Groups({"products"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="product")
     * @Serializer\Groups({"products"})
     */
    private $orderDetails;


    /**
     * @ORM\OneToMany(targetEntity=CartDetails::class, mappedBy="product")
     */
    private $cartDetails;

    public function __construct()
    {
        $this->cartDetails = new ArrayCollection();
    }

    
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CartDetails>
     */
    public function getCartDetails(): Collection
    {
        return $this->cartDetails;
    }

    public function addCartDetail(CartDetails $cartDetail): self
    {
        if (!$this->cartDetails->contains($cartDetail)) {
            $this->cartDetails[] = $cartDetail;
            $cartDetail->setProduct($this);
        }

        return $this;
    }

    public function removeCartDetail(CartDetails $cartDetail): self
    {
        if ($this->cartDetails->removeElement($cartDetail)) {
            // set the owning side to null (unless already changed)
            if ($cartDetail->getProduct() === $this) {
                $cartDetail->setProduct(null);
            }
        }

        return $this;
    }

  

}
