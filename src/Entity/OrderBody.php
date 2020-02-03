<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OrderBodyRepository")
 */
class OrderBody
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderHead", inversedBy="orderBodies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_order_head;

    /**
     * @ORM\Column(type="decimal", precision=13, scale=0)
     */
    private $barcode;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $cost;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $tax_perc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $tax_amt;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=0)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tracking_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canceled;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipped_status_sku;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrderHead(): ?OrderHead
    {
        return $this->id_order_head;
    }

    public function setIdOrderHead(?OrderHead $id_order_head): self
    {
        $this->id_order_head = $id_order_head;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getTaxPerc(): ?string
    {
        return $this->tax_perc;
    }

    public function setTaxPerc(string $tax_perc): self
    {
        $this->tax_perc = $tax_perc;

        return $this;
    }

    public function getTaxAmt(): ?string
    {
        return $this->tax_amt;
    }

    public function setTaxAmt(string $tax_amt): self
    {
        $this->tax_amt = $tax_amt;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getCanceled(): ?string
    {
        if ($this->canceled === 0)
        {
            return "N";
        } else
        {
            return "Y";
        }
    }

    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getShippedStatusSku(): ?string
    {
        if ($this->shipped_status_sku == false)
        {
            return "not sent";
        } else
        {
            return "sent";
        }
    }

    public function setShippedStatusSku(bool $shipped_status_sku): self
    {
        $this->shipped_status_sku = $shipped_status_sku;

        return $this;
    }
}
