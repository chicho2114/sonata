<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ContEmergencia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\ContEmergenciaRepository")
 */
class ContEmergencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="relacion", type="string", length=255)
     */
    private $relacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;


    /**
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="contactoEmerg")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     */
    protected $paciente;

    /**
     * @ORM\OneToMany(targetEntity="Telefono", mappedBy="contEmerg", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $telefonos;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFecha(new \DateTime());
        $this->telefonos = new ArrayCollection();
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre() .' '. $this->getApellido() .' - ' . $this->getRelacion();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ContEmergencia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return ContEmergencia
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set relacion
     *
     * @param string $relacion
     * @return ContEmergencia
     */
    public function setRelacion($relacion)
    {
        $this->relacion = $relacion;

        return $this;
    }

    /**
     * Get relacion
     *
     * @return string 
     */
    public function getRelacion()
    {
        return $this->relacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ContEmergencia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set paciente
     *
     * @param \Admin\AdminBundle\Entity\Paciente $paciente
     * @return ContEmergencia
     */
    public function setPaciente(\Admin\AdminBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \Admin\AdminBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Add telefonos
     *
     * @param \Admin\AdminBundle\Entity\Telefono $telefonos
     * @return ContEmergencia
     */
    public function addTelefono(\Admin\AdminBundle\Entity\Telefono $telefonos)
    {
        $telefonos->setContEmerg($this);
        $this->telefonos->add($telefonos);
    }

    /**
     * Remove telefonos
     *
     * @param \Admin\AdminBundle\Entity\Telefono $telefonos
     */
    public function removeTelefono(\Admin\AdminBundle\Entity\Telefono $telefonos)
    {
        $this->telefonos->removeElement($telefonos);
    }

    /**
     * Get telefonos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    public function setTelefonos($telefonos)
    {
        if (count($telefonos) > 0) {
            foreach ($telefonos as $telefono) {
                $this->addTelefono($telefono);
            }
        }

        return $this;
    }
}
