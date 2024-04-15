<?php

namespace App\Entity;

use App\Repository\GiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiftRepository::class)]
class Gift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: GiftList::class, mappedBy: 'gifts')]
    private Collection $giftLists;

    public function __construct()
    {
        $this->giftLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, GiftList>
     */
    public function getGiftLists(): Collection
    {
        return $this->giftLists;
    }

    public function addGiftList(GiftList $giftList): static
    {
        if (!$this->giftLists->contains($giftList)) {
            $this->giftLists->add($giftList);
            $giftList->addGift($this);
        }

        return $this;
    }

    public function removeGiftList(GiftList $giftList): static
    {
        if ($this->giftLists->removeElement($giftList)) {
            $giftList->removeGift($this);
        }

        return $this;
    }
}
