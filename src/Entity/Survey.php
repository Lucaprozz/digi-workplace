<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyRepository")
 */
class Survey
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Route;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="survey")
     */
    private $S_id;

    public function __construct()
    {
        $this->S_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): ?string
    {
        return $this->Route;
    }

    public function setRoute(string $Route): self
    {
        $this->Route = $Route;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getSId(): Collection
    {
        return $this->S_id;
    }

    public function addSId(Question $sId): self
    {
        if (!$this->S_id->contains($sId)) {
            $this->S_id[] = $sId;
            $sId->setSurvey($this);
        }

        return $this;
    }

    public function removeSId(Question $sId): self
    {
        if ($this->S_id->contains($sId)) {
            $this->S_id->removeElement($sId);
            // set the owning side to null (unless already changed)
            if ($sId->getSurvey() === $this) {
                $sId->setSurvey(null);
            }
        }

        return $this;
    }
}
