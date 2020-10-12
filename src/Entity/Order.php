<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $order_uid;

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

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="order", orphanRemoval=true,cascade={"persist"})
     */
    private $order_items;

    public function __construct()
    {
        $this->order_items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderUid(): ?string
    {
        return $this->order_uid;
    }

    public function setOrderUid(string $order_uid): self
    {
        $this->order_uid = $order_uid;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone = null): self
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

    public function getOrderItems(): ?Collection
    {
        return $this->order_items;
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

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->order_items->contains($orderItem)) {
            $this->order_items[] = $orderItem;
            $orderItem->setOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->order_items->contains($orderItem)) {
            $this->order_items->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrder() === $this) {
                $orderItem->setOrder(null);
            }
        }

        return $this;
    }
}
