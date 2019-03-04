<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message = "Le format de votre email n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     * Assert\NotBlank(message="New password can not be blank.")
     * Assert\Regex(pattern="/^(?=.*[a-z])(?=.*\d).{6,}$/i", message="Password is required to be minimum 6 chars in
      length and to include at least one letter and one number.")
     */

    private $password;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Company", mappedBy="user", cascade={"persist", "remove"})
     */
    private $company;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", mappedBy="user", cascade={"persist", "remove"})
     */
    private $student;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\School", mappedBy="user", cascade={"persist", "remove"})
     */
    private $school;

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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
//TODO: Voir avec aurélien pour l utilisation de erase
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return User
     */
    public function setCompany(Company $company): self
    {
        $this->company = $company;
        // set the owning side of the relation if necessary
        if ($this !== $company->getUser()) {
            $company->setUser($this);
        }
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
     * @param Student $student
     * @return User
     */
    public function setStudent(Student $student): self
    {
        $this->student = $student;
        // set the owning side of the relation if necessary
        if ($this !== $student->getUser()) {
            $student->setUser($this);
        }
        return $this;
    }

    /**
     * @return School|null
     */
    public function getSchool(): ?School
    {
        return $this->school;
    }

    /**
     * @param School $school
     * @return User
     */
    public function setSchool(School $school): self
    {
        $this->school = $school;
        // set the owning side of the relation if necessary
        if ($this !== $school->getUser()) {
            $school->setUser($this);
        }
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function __toString()
    {

        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
}
