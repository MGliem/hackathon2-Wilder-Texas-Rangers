<?php

namespace App\Entity;

use App\Repository\MatchingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchingRepository::class)]
class Matching
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'matching', targetEntity: User::class)]
    private $apsidian;

    #[ORM\OneToMany(mappedBy: 'matching', targetEntity: User::class)]
    private $masterChief;

    #[ORM\OneToMany(mappedBy: 'matching', targetEntity: Project::class)]
    private $project;

    public function __construct()
    {
        $this->apsidian = new ArrayCollection();
        $this->masterChief = new ArrayCollection();
        $this->project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getApsidian(): Collection
    {
        return $this->apsidian;
    }

    public function addApsidian(User $apsidian): self
    {
        if (!$this->apsidian->contains($apsidian)) {
            $this->apsidian[] = $apsidian;
            $apsidian->setMatching($this);
        }

        return $this;
    }

    public function removeApsidian(User $apsidian): self
    {
        if ($this->apsidian->removeElement($apsidian)) {
            // set the owning side to null (unless already changed)
            if ($apsidian->getMatching() === $this) {
                $apsidian->setMatching(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getMasterChief(): Collection
    {
        return $this->masterChief;
    }

    public function addMasterChief(User $masterChief): self
    {
        if (!$this->masterChief->contains($masterChief)) {
            $this->masterChief[] = $masterChief;
            $masterChief->setMatching($this);
        }

        return $this;
    }

    public function removeMasterChief(User $masterChief): self
    {
        if ($this->masterChief->removeElement($masterChief)) {
            // set the owning side to null (unless already changed)
            if ($masterChief->getMatching() === $this) {
                $masterChief->setMatching(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Project $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
            $project->setMatching($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->project->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getMatching() === $this) {
                $project->setMatching(null);
            }
        }

        return $this;
    }
}
