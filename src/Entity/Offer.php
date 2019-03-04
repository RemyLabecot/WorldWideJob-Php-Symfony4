<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $begin;

    /**
     * @ORM\Column(type="string")
     */
    private $duration;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobDomain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tutor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $drivingLicence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Student", inversedBy="applicant", fetch="EAGER", cascade = "persist")
     * @ORM\JoinTable(name="candidates_students")
     */
    private $candidates;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Student", inversedBy="favorite", fetch="EAGER", cascade = "persist")
     */
    private $subscribers;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Offer constructor.
     */
    public function __construct()
    {
        $this->candidates = new ArrayCollection();
        $this->subscribers = new ArrayCollection();
    }

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Offer
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @param string $description
     * @return Offer
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Offer
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBegin(): ?\DateTime
    {
        return $this->begin;
    }

    /**
     * @param \DateTime $begin
     * @return Offer
     */
    public function setBegin(\DateTime $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return Offer
     */
    public function setDuration(string $duration): self
    {
        $this->duration = $duration;
        return $this;
    }
    /**
     * @return null|string
     */
    public function getJobDomain(): ?string
    {
        return $this->jobDomain;
    }

    /**
     * @param string $jobDomain
     * @return Offer
     */
    public function setJobDomain(string $jobDomain): self
    {
        $this->jobDomain = $jobDomain;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return Offer
     */
    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalary(): ?string
    {
        return $this->salary;
    }

    /**
     * @param null|string $salary
     * @return Offer
     */
    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTutor(): ?string
    {
        return $this->tutor;
    }

    /**
     * @param null|string $tutor
     * @return Offer
     */
    public function setTutor(?string $tutor): self
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDrivingLicence(): ?string
    {
        return $this->drivingLicence;
    }

    /**
     * @param null|string $drivingLicence
     * @return Offer
     */
    public function setDrivingLicence(?string $drivingLicence): self
    {
        $this->drivingLicence = $drivingLicence;

        return $this;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     * @return Offer
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return Collection|Student[]
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    /**
     * @param Student $candidate
     * @return Offer
     */
    public function addCandidate(Student $candidate): self
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates[] = $candidate;
        }

        return $this;
    }

    /**
     * @param Student $candidate
     * @return Offer
     */
    public function removeCandidate(Student $candidate): self
    {
        if ($this->candidates->contains($candidate)) {
            $this->candidates->removeElement($candidate);
        }

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    /**
     * @param Student $subscriber
     * @return Offer
     */
    public function addSubscriber(Student $subscriber): self
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    /**
     * @param Student $subscriber
     * @return Offer
     */
    public function removeSubscriber(Student $subscriber): self
    {
        if ($this->subscribers->contains($subscriber)) {
            $this->subscribers->removeElement($subscriber);
        }

        return $this;
    }
}
