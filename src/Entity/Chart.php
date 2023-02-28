<?php

namespace App\Entity;

use App\Repository\ChartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChartRepository::class)
 */
class Chart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=user::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=product::class, mappedBy="chart")
     */
    private $product_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="cart")
     */
    private $yes;

    public function __construct()
    {
        $this->product_id = new ArrayCollection();
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, product>
     */
    public function getProductId(): Collection
    {
        return $this->product_id;
    }

    public function addProductId(product $productId): self
    {
        if (!$this->product_id->contains($productId)) {
            $this->product_id[] = $productId;
            $productId->setChart($this);
        }

        return $this;
    }

    public function removeProductId(product $productId): self
    {
        if ($this->product_id->removeElement($productId)) {
            // set the owning side to null (unless already changed)
            if ($productId->getChart() === $this) {
                $productId->setChart(null);
            }
        }

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

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Product $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->addCart($this);
        }

        return $this;
    }

    public function removeYe(Product $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            $ye->removeCart($this);
        }

        return $this;
    }
}
