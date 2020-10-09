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
     * @ORM\Column(type="string", length=32)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $shipping_status;

    /**
     * @ORM\Column(type="float")
     */
    private $shipping_price;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $shipping_payment_status;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $payment_status;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $currency;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $order_amount;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $orderItems = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getShippingStatus(): ?string
    {
        return $this->shipping_status;
    }

    public function setShippingStatus(string $shipping_status): self
    {
        $this->shipping_status = $shipping_status;

        return $this;
    }

    public function getShippingPrice(): ?float
    {
        return $this->shipping_price;
    }

    public function setShippingPrice(float $shipping_price): self
    {
        $this->shipping_price = $shipping_price;

        return $this;
    }

    public function getShippingPaymentStatus(): ?string
    {
        return $this->shipping_payment_status;
    }

    public function setShippingPaymentStatus(string $shipping_payment_status): self
    {
        $this->shipping_payment_status = $shipping_payment_status;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOrderItems(): ?array
    {
        return $this->orderItems;
    }

    public function setOrderItems(?array $orderItems): self
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    public function getOrderAmount(): ?float
    {
        return $this->order_amount;
    }

    public function setOrderAmount(float $orderAmount): self
    {
        $this->order_amount = $orderAmount;

        return $this;
    }
}
