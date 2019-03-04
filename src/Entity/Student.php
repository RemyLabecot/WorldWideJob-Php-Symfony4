<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as ValidationAssert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @Vich\Uploadable
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="profil_image_student", fileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @ValidationAssert\ContainsName
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @ValidationAssert\ContainsName
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\Regex(pattern="/\d{10}[A-Z]/", message="Veuillez entrer une valeur valide.")
     */
    private $ine;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @ValidationAssert\ContainsPhone
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @ValidationAssert\ContainsZipCode
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country = "FRANCE";

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $civility;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="student", cascade="all")
     */
    private $experiences;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Skill", mappedBy="student")
     */
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Offer", mappedBy="candidates")
     */
    private $applicant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Offer", mappedBy="subscribers", fetch="EAGER")
     */
    private $favorite;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="student", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="student", cascade="all")
     */
    private $formation;


    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->applicant = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->formation = new ArrayCollection();
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
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Student
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Student
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getIne(): ?string
    {
        return $this->ine;
    }

    /**
     * @param null|string $ine
     * @return Student
     */
    public function setIne(?string $ine): self
    {
        $this->ine = $ine;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Student
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return Student
     */
    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param null|string $address2
     * @return Student
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Student
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Student
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Student
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCivility(): ?string
    {
        return $this->civility;
    }

    /**
     * @param string $civility
     * @return Student
     */
    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Student
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
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
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    /**
     * @param Experience $experience
     * @return Student
     */
    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setStudent($this);
        }
        return $this;
    }

    /**
     * @param Experience $experience
     * @return Student
     */
    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getStudent() === $this) {
                $experience->setStudent(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return Student
     */
    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->addStudent($this);
        }

        return $this;
    }

    /**
     * @param Skill $skill
     * @return Student
     */
    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            $skill->removeStudent($this);
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getApplicant(): Collection
    {
        return $this->applicant;
    }

    /**
     * @param Offer $applicant
     * @return Student
     */
    public function addApplicant(Offer $applicant): self
    {
        if (!$this->applicant->contains($applicant)) {
            $this->applicant[] = $applicant;
            $applicant->addCandidate($this);
        }

        return $this;
    }

    /**
     * @param Offer $applicant
     * @return Student
     */
    public function removeApplicant(Offer $applicant): self
    {
        if ($this->applicant->contains($applicant)) {
            $this->applicant->removeElement($applicant);
            $applicant->removeCandidate($this);
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    /**
     * @param Offer $favorite
     * @return Student
     */
    public function addFavorite(Offer $favorite): self
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite[] = $favorite;
            $favorite->addSubscriber($this);
        }

        return $this;
    }

    /**
     * @param Offer $favorite
     * @return Student
     */
    public function removeFavorite(Offer $favorite): self
    {
        if ($this->favorite->contains($favorite)) {
            $this->favorite->removeElement($favorite);
            $favorite->removeSubscriber($this);
        }
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     * @return Student
     */
    public function setBirthdate(\DateTime $birthdate): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formation;
    }

    /**
     * @param Formation $formation
     * @return Student
     */
    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
            $formation->setStudent($this);
        }
        return $this;
    }

    /**
     * @param Formation $formation
     * @return Student
     */
    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->contains($formation)) {
            $this->formation->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getStudent() === $this) {
                $formation->setStudent(null);
            }
        }
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return Student
     */
    public function setImageName(?string $imageName): Student
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTimeInterface $updated_at
     * @return Student
     */
    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
