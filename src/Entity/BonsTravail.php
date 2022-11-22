<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\BonsTravailRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: BonsTravailRepository::class)]
class BonsTravail
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: 'date')]
    private $dateExecutionPrevue;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $heureArrivee;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observations;

    #[ORM\Column(type: 'text')]
    private $travail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $etat;

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

    #[ORM\Column(type: "boolean", nullable: true)]
    private $signe;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $signature;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $bonPdf;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $lattitudeDepart;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $lattitudeArrivee;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $longitudeDepart;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $longitudeArrivee;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $nomSignature;

    #[ORM\Column(type: "boolean", nullable: true)]
    private $enregistre;

    #[ORM\Column(type: "time", nullable: true)]
    private $heureagent;

    #[ORM\Column(type: "time", nullable: true)]
    private $tempsTravail;

    #[ORM\Column(type: "string", nullable: true)]
    private $imageName;

    #[ORM\Column(type: "string", nullable: true)]
    private $imageNameAgent;

    #[ORM\ManyToOne(inversedBy: 'bonsTravail', )]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Agent::class, inversedBy: 'bonsTravail')]
    private Collection $agents;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;




    public function __construct()
    {
        $this->agents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }




    /**
     * @param ArrayCollection|Collection $agents
     */
    public function setAgents(ArrayCollection|Collection $agents): void
    {
        $this->agents = $agents;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }




    /**
     * @return mixed
     */
    public function getDateExecutionPrevue()
    {
        return $this->dateExecutionPrevue;
    }

    /**
     * @param mixed $dateExecutionPrevue
     */
    public function setDateExecutionPrevue($dateExecutionPrevue): void
    {
        $this->dateExecutionPrevue = $dateExecutionPrevue;
    }

    /**
     * @return mixed
     */
    public function getHeureArrivee()
    {
        return $this->heureArrivee;
    }

    /**
     * @param mixed $heureArrivee
     */
    public function setHeureArrivee($heureArrivee): void
    {
        $this->heureArrivee = $heureArrivee;
    }

    /**
     * @return mixed
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param mixed $observations
     */
    public function setObservations($observations): void
    {
        $this->observations = $observations;
    }

    /**
     * @return mixed
     */
    public function getTravail()
    {
        return $this->travail;
    }

    /**
     * @param mixed $travail
     */
    public function setTravail($travail): void
    {
        $this->travail = $travail;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
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
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }



    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }



    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }



    /**
     * @return mixed
     */
    public function getSigne()
    {
        return $this->signe;
    }

    /**
     * @param mixed $signe
     */
    public function setSigne($signe): void
    {
        $this->signe = $signe;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getBonPdf()
    {
        return $this->bonPdf;
    }

    /**
     * @param mixed $bonPdf
     */
    public function setBonPdf($bonPdf): void
    {
        $this->bonPdf = $bonPdf;
    }

    /**
     * @return mixed
     */
    public function getLattitudeDepart()
    {
        return $this->lattitudeDepart;
    }

    /**
     * @param mixed $lattitudeDepart
     */
    public function setLattitudeDepart($lattitudeDepart): void
    {
        $this->lattitudeDepart = $lattitudeDepart;
    }

    /**
     * @return mixed
     */
    public function getLattitudeArrivee()
    {
        return $this->lattitudeArrivee;
    }

    /**
     * @param mixed $lattitudeArrivee
     */
    public function setLattitudeArrivee($lattitudeArrivee): void
    {
        $this->lattitudeArrivee = $lattitudeArrivee;
    }

    /**
     * @return mixed
     */
    public function getLongitudeDepart()
    {
        return $this->longitudeDepart;
    }

    /**
     * @param mixed $longitudeDepart
     */
    public function setLongitudeDepart($longitudeDepart): void
    {
        $this->longitudeDepart = $longitudeDepart;
    }

    /**
     * @return mixed
     */
    public function getLongitudeArrivee()
    {
        return $this->longitudeArrivee;
    }

    /**
     * @param mixed $longitudeArrivee
     */
    public function setLongitudeArrivee($longitudeArrivee): void
    {
        $this->longitudeArrivee = $longitudeArrivee;
    }

    /**
     * @return mixed
     */
    public function getNomSignature()
    {
        return $this->nomSignature;
    }

    /**
     * @param mixed $nomSignature
     */
    public function setNomSignature($nomSignature): void
    {
        $this->nomSignature = $nomSignature;
    }

    /**
     * @return mixed
     */
    public function getEnregistre()
    {
        return $this->enregistre;
    }

    /**
     * @param mixed $enregistre
     */
    public function setEnregistre($enregistre): void
    {
        $this->enregistre = $enregistre;
    }

    /**
     * @return mixed
     */
    public function getHeureagent()
    {
        return $this->heureagent;
    }

    /**
     * @param mixed $heureagent
     */
    public function setHeureagent($heureagent): void
    {
        $this->heureagent = $heureagent;
    }

    /**
     * @return mixed
     */
    public function getTempsTravail()
    {
        return $this->tempsTravail;
    }

    /**
     * @param mixed $tempsTravail
     */
    public function setTempsTravail($tempsTravail): void
    {
        $this->tempsTravail = $tempsTravail;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName): void
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageNameAgent()
    {
        return $this->imageNameAgent;
    }

    /**
     * @param mixed $imageNameAgent
     */
    public function setImageNameAgent($imageNameAgent): void
    {
        $this->imageNameAgent = $imageNameAgent;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Agent>
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents->add($agent);
            $agent->addBonsTravail($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            $agent->removeBonsTravail($this);
        }

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
    public function __toString(): string
    {
        return $this->id;


    }

    public function listeAgents(): ?string
    {
        $string  = '';

        /** @var Agent $agent */
        foreach ($this->agents as $agent){
            $string .= ', ' . $agent->getNom();
        }
        return ltrim($string, ', ');
    }



}
