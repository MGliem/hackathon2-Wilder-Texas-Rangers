<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'array')]
    private $skills = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $agency;

    #[ORM\Column(type: 'string', length: 255)]
    private $bio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $points;

    #[ORM\OneToMany(mappedBy: 'apsidian', targetEntity: Matching::class)]
    private $apsidianMatchs;

    #[ORM\OneToMany(mappedBy: 'masterChief', targetEntity: Matching::class)]
    private $masterMatchs;

    public function __construct()
    {
        $this->apsidianMatchs = new ArrayCollection();
        $this->masterMatchs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

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
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSkills(): ?array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getAgency(): ?string
    {
        return $this->agency;
    }

    public function setAgency(string $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection<int, Matching>
     */
    public function getApsidianMatchs(): Collection
    {
        return $this->apsidianMatchs;
    }

    public function addApsidianMatch(Matching $apsidianMatch): self
    {
        if (!$this->apsidianMatchs->contains($apsidianMatch)) {
            $this->apsidianMatchs[] = $apsidianMatch;
            $apsidianMatch->setApsidian($this);
        }

        return $this;
    }

    public function removeApsidianMatch(Matching $apsidianMatch): self
    {
        if ($this->apsidianMatchs->removeElement($apsidianMatch)) {
            // set the owning side to null (unless already changed)
            if ($apsidianMatch->getApsidian() === $this) {
                $apsidianMatch->setApsidian(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matching>
     */
    public function getMasterMatchs(): Collection
    {
        return $this->masterMatchs;
    }

    public function addMasterMatch(Matching $masterMatch): self
    {
        if (!$this->masterMatchs->contains($masterMatch)) {
            $this->masterMatchs[] = $masterMatch;
            $masterMatch->setMasterChief($this);
        }

        return $this;
    }

    public function removeMasterMatch(Matching $masterMatch): self
    {
        if ($this->masterMatchs->removeElement($masterMatch)) {
            // set the owning side to null (unless already changed)
            if ($masterMatch->getMasterChief() === $this) {
                $masterMatch->setMasterChief(null);
            }
        }

        return $this;
    }
}
