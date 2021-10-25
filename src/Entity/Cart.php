<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cartLines;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orderCart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartLines(): ?string
    {
        return $this->cartLines;
    }

    public function setCartLines(string $cartLines): self
    {
        $this->cartLines = $cartLines;

        return $this;
    }

    public function getOrderCart(): ?string
    {
        return $this->orderCart;
    }

    public function setOrderCart(string $orderCart): self
    {
        $this->orderCart = $orderCart;

        return $this;
    }
}
