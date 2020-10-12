<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Order;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="order_items", fetch="EAGER",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $order_uid;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $barcode;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $tax_perc;

    /**
     * @ORM\Column(type="float")
     */
    private $tax_amt;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $tracking_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canceled;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $shipped_status_sku;

    public function getId(): ?int
    {
        return $this->id;
    }

    //public function getOrder(): ?Order
    //{
    //    return $this->order;
    //}

    public function setOrder(Order $orderId): self
    {
        $this->order = $orderId;

        return $this;
    }

    public function getOrderUid(): ?string
    {
        return $this->order_uid;
    }

    public function setOrderUid(string $orderUid): self
    {
        $this->order_uid = $orderUid;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
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

    public function getTaxPerc(): ?float
    {
        return $this->tax_perc;
    }

    public function setTaxPerc(float $tax_perc): self
    {
        $this->tax_perc = $tax_perc;

        return $this;
    }

    public function getTaxAmt(): ?float
    {
        return $this->tax_amt;
    }

    public function setTaxAmt(float $tax_amt): self
    {
        $this->tax_amt = $tax_amt;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->tracking_number;
    }

    public function setTrackingNumber(?string $tracking_number): self
    {
        $this->tracking_number = $tracking_number;

        return $this;
    }

    public function getCanceled(): ?bool
    {
        return $this->canceled;
    }

    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getShippedStatusSku(): ?string
    {
        return $this->shipped_status_sku;
    }

    public function setShippedStatusSku(string $shipped_status_sku): self
    {
        $this->shipped_status_sku = $shipped_status_sku;

        return $this;
    }
}
