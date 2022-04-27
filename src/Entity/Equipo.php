<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipoRepository::class)
 */
class Equipo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $liga;

    /**
     * @ORM\Column(type="integer")
     */
    private $tam_plantilla;

    /**
     * @ORM\Column(type="float")
     */
    private $presupuesto;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_fundacion;

    /**
     * @ORM\OneToMany(targetEntity=Jugador::class, mappedBy="equipo")
     */
    private $jugador;

    public function __construct()
    {
        $this->jugador = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLiga(): ?int
    {
        return $this->liga;
    }

    public function setLiga(int $liga): self
    {
        $this->liga = $liga;

        return $this;
    }

    public function getTamPlantilla(): ?int
    {
        return $this->tam_plantilla;
    }

    public function setTamPlantilla(int $tam_plantilla): self
    {
        $this->tam_plantilla = $tam_plantilla;

        return $this;
    }

    public function getPresupuesto(): ?float
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(float $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getFechaFundacion(): ?\DateTimeInterface
    {
        return $this->fecha_fundacion;
    }

    public function setFechaFundacion(\DateTimeInterface $fecha_fundacion): self
    {
        $this->fecha_fundacion = $fecha_fundacion;

        return $this;
    }

    /**
     * @return Collection<int, Jugador>
     */
    public function getJugador(): Collection
    {
        return $this->jugador;
    }

    public function addJugador(Jugador $jugador): self
    {
        if (!$this->jugador->contains($jugador)) {
            $this->jugador[] = $jugador;
            $jugador->setEquipo($this);
        }

        return $this;
    }

    public function removeJugador(Jugador $jugador): self
    {
        if ($this->jugador->removeElement($jugador)) {
            // set the owning side to null (unless already changed)
            if ($jugador->getEquipo() === $this) {
                $jugador->setEquipo(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}
