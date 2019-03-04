<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formationName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diploma;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domain;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $beginDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="formation")
     */
    private $student;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getFormationName(): ?string
    {
        return $this->formationName;
    }

    /**
     * @param null|string $formationName
     * @return Formation
     */
    public function setFormationName(?string $formationName): self
    {
        $this->formationName = $formationName;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    /**
     * @param null|string $diploma
     * @return Formation
     */
    public function setDiploma(?string $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param null|string $domain
     * @return Formation
     */
    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBeginDate(): ?\DateTime
    {
        return $this->beginDate;
    }

    /**
     * @param \DateTime|null $beginDate
     * @return Formation
     */
    public function setBeginDate(?\DateTime $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime|null $endDate
     * @return Formation
     */
    public function setEndDate(?\DateTime $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Formation
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Student|null
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student|null $student
     * @return Formation
     */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
