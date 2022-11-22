<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;


    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Blameable(on: 'create')]
    private $createdBy;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Blameable(on: 'update')]
    private $updatedBy;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToOne(inversedBy: 'agent', cascade: ['persist', 'remove'])]
    private ?User $Users = null;

    #[ORM\ManyToMany(targetEntity: BonsTravail::class, mappedBy: 'agents')]
    private Collection $bonsTravail;

    #[ORM\OneToMany(mappedBy: 'agent', targetEntity: BonsMateriel::class)]
    private Collection $bonsMat;




    public function __construct()
    {
        $this->bonsTravail = new ArrayCollection();
        $this->bonsMat = new ArrayCollection();


    }




    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param Collection $bonsTravail
     */
    public function setBonsTravail(Collection $bonsTravail): void
    {
        $this->bonsTravail = $bonsTravail;
    }

    /**
     * @param Collection $bonsMat
     */
    public function setBonsMat(Collection $bonsMat): void
    {
        $this->bonsMat = $bonsMat;
    }





    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->Users;
    }

    public function setUsers(?User $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    /**
     * @return Collection<int, BonsTravail>
     */
    public function getBonsTravail(): Collection
    {
        return $this->bonsTravail;
    }

    public function addBonsTravail(BonsTravail $bonsTravail): self
    {
        if (!$this->bonsTravail->contains($bonsTravail)) {
            $this->bonsTravail->add($bonsTravail);
        }

        return $this;
    }

    public function removeBonsTravail(BonsTravail $bonsTravail): self
    {
        $this->bonsTravail->removeElement($bonsTravail);

        return $this;
    }

    /**
     * @return Collection<int, BonsMateriel>
     */
    public function getBonsMat(): Collection
    {
        return $this->bonsMat;
    }

    public function addBonsMat(BonsMateriel $bonsMat): self
    {
        if (!$this->bonsMat->contains($bonsMat)) {
            $this->bonsMat->add($bonsMat);
            $bonsMat->setAgent($this);
        }

        return $this;
    }

    public function removeBonsMat(BonsMateriel $bonsMat): self
    {
        if ($this->bonsMat->removeElement($bonsMat)) {
            // set the owning side to null (unless already changed)
            if ($bonsMat->getAgent() === $this) {
                $bonsMat->setAgent(null);
            }
        }

        return $this;
    }



}

