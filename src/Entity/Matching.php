<?php

namespace App\Entity;

use App\Repository\MatchingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchingRepository::class)]
class Matching
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'apsidianMatchs')]
    #[ORM\JoinColumn(nullable: false)]
    private $apsidian;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'masterMatchs')]
    private $masterChief;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'matchings')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    #[ORM\Column(type: 'boolean')]
    private $apsidianLike;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApsidian(): ?User
    {
        return $this->apsidian;
    }

    public function setApsidian(?User $apsidian): self
    {
        $this->apsidian = $apsidian;

        return $this;
    }

    public function getMasterChief(): ?User
    {
        return $this->masterChief;
    }

    public function setMasterChief(?User $masterChief): self
    {
        $this->masterChief = $masterChief;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function isApsidianLike(): ?bool
    {
        return $this->apsidianLike;
    }

    public function setApsidianLike(bool $apsidianLike): self
    {
        $this->apsidianLike = $apsidianLike;

        return $this;
    }
}
