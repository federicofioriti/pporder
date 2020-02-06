<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     subresourceOperations=
 *     {
 *          "api_order_heads_order_bodies_get_subresource"=
 *          {
 *              "method"="GET",
 *              "path"="/orders/{id}"
 *          }
 *     }
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\OrderHeadRepository")
 * @ORM\Table(name="order_head")
 */
class OrderHead
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipping_status;
    
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $shipping_price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipping_payment_status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $payment_status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderBody", mappedBy="id_order_head", orphanRemoval=true)
     * @ApiSubresource()
     */
    private $orderBodies;

    /**
     * @ORM\Column(type="date")
     */
    private $data_ordine;

    public function __construct()
    {
        $this->orderBodies = new ArrayCollection();
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getId(): ?string
    {
        return $this->id;
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
        if ($this->shipping_status == false)
        {
            return "not sent";
        } else
        {
            return "sent";
        }
    }

    public function setShippingStatus(bool $shipping_status): self
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
        if ($this->shipping_payment_status == false)
        {
            return "not sent";
        } else
        {
            return "sent";
        }
    }

    public function setShippingPaymentStatus(bool $shipping_payment_status): self
    {
        $this->shipping_payment_status = $shipping_payment_status;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        if ($this->payment_status == false)
        {
            return "not sent";
        } else
        {
            return "sent";
        }
    }

    public function setPaymentStatus(bool $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    /**
     * @return Collection|OrderBody[]
     */
    public function getOrderBodies(): Collection
    {
        return $this->orderBodies;
    }

    public function addOrderBody(OrderBody $orderBody): self
    {
        if (!$this->orderBodies->contains($orderBody)) {
            $this->orderBodies[] = $orderBody;
            $orderBody->setIdOrderHead($this);
        }

        return $this;
    }

    public function removeOrderBody(OrderBody $orderBody): self
    {
        if ($this->orderBodies->contains($orderBody)) {
            $this->orderBodies->removeElement($orderBody);
            // set the owning side to null (unless already changed)
            if ($orderBody->getIdOrderHead() === $this) {
                $orderBody->setIdOrderHead(null);
            }
        }

        return $this;
    }

    public function getDataOrdine(): ?\DateTime
    {
        return $this->data_ordine;
    }

    public function setDataOrdine($data_ordine): self
    {
        $this->data_ordine = $data_ordine;

        return $this;
    }
}
