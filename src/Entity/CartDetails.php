<?php

namespace App\Entity;

use App\Repository\CartDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
/**
 * @ORM\Entity(repositoryClass=CartDetailsRepository::class)
 */
class CartDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"cartDetails"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"cartDetails"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartDetails")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"cartDetails"})
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="cartDetails")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"cartDetails"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
