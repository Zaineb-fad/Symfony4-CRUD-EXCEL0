<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $trackNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderBookDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bookTalbe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryOption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="text")
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusHistory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrackNumber(): ?int
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): self
    {
        $this->trackNumber = $trackNumber;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderBookDate(): ?\DateTimeInterface
    {
        return $this->orderBookDate;
    }

    public function setOrderBookDate(\DateTimeInterface $orderBookDate): self
    {
        $this->orderBookDate = $orderBookDate;

        return $this;
    }

    public function getBookTalbe(): ?bool
    {
        return $this->bookTalbe;
    }

    public function setBookTalbe(bool $bookTalbe): self
    {
        $this->bookTalbe = $bookTalbe;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDeliveryOption(): ?string
    {
        return $this->deliveryOption;
    }

    public function setDeliveryOption(string $deliveryOption): self
    {
        $this->deliveryOption = $deliveryOption;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCarts(): ?string
    {
        return $this->carts;
    }

    public function setCarts(string $carts): self
    {
        $this->carts = $carts;

        return $this;
    }

    public function getStatusHistory(): ?string
    {
        return $this->statusHistory;
    }

    public function setStatusHistory(string $statusHistory): self
    {
        $this->statusHistory = $statusHistory;

        return $this;
    }
}
