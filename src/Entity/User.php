<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="user")
     */
    private $F_Id;

    public function __construct()
    {
        parent::__construct();
        $this->F_Id = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Answer[]
     */
    public function getFId(): Collection
    {
        return $this->F_Id;
    }

    public function addFId(Answer $fId): self
    {
        if (!$this->F_Id->contains($fId)) {
            $this->F_Id[] = $fId;
            $fId->setUser($this);
        }

        return $this;
    }

    public function removeFId(Answer $fId): self
    {
        if ($this->F_Id->contains($fId)) {
            $this->F_Id->removeElement($fId);
            // set the owning side to null (unless already changed)
            if ($fId->getUser() === $this) {
                $fId->setUser(null);
            }
        }

        return $this;
    }
}