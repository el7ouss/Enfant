<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 15:17
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="adhesion")
 * @ORM\Entity
 */

class Adhesion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column( name="type",type="string")
     */
    protected $type;
    /**
     * @ORM\Column( name="typePaiement",type="string")
     */
    protected $typePaiement;
    /**
     * @ORM\Column( name="montant",type="integer")
     */
    protected $montant;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false)
     *
     */
    private $enable = false;

    /**
     * @var Eleve
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Eleve", inversedBy="adhesion")
     * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id")
     */
    private $eleve ;

    /**
     * @var  ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Paiement", mappedBy="adhesion")
     */
    private $paiement;

    public function __construct()
    {
        $this->paiement = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }

    /**
     * @param mixed $typePaiement
     */
    public function setTypePaiement($typePaiement)
    {
        $this->typePaiement = $typePaiement;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param Eleve $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return bool
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return ArrayCollection
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * @param ArrayCollection $paiement
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;
    }



}