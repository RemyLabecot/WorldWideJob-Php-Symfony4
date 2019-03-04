<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="experiences")
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyBrand;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $beginDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Experience
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return Experience
     */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompanyBrand(): ?string
    {
        return $this->companyBrand;
    }

    /**
     * @param null|string $companyBrand
     * @return Experience
     */
    public function setCompanyBrand(?string $companyBrand): self
    {
        $this->companyBrand = $companyBrand;

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
     * @param \DateTime $beginDate
     * @return Experience
     */
    public function setBeginDate(\DateTime $beginDate): self
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
     * @param \DateTime $endDate
     * @return Experience
     */
    public function setEndDate(\DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return Experience
     */
    public function setPlace(string $place): self
    {
        $this->place = $place;

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
     * @return Experience
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
