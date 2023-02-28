<?php

namespace App\Entity;

use App\Repository\OrderDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailsRepository::class)
 */
class OrderDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=order::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderDetails")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quatity;

    /**
     * @ORM\Column(type="integer")
     */
    private $unit_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?order
    {
        return $this->order_id;
    }

    public function setOrderId(?order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuatity(): ?int
    {
        return $this->quatity;
    }

    public function setQuatity(int $quatity): self
    {
        $this->quatity = $quatity;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unit_price;
    }

    public function setUnitPrice(int $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }
}
