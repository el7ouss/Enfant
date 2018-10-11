<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 15:08
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groupe")
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column( name="libelle",type="string")
     */
    protected $libelle;
    /**
     * @ORM\Column( name="nb_max",type="integer")
     */
    protected $nbMax;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Eleve", mappedBy="groupe")
     */
    private $eleve;

    /**
     * @var  ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Activite", mappedBy="groupe")
     */
    private $activite;


    /**
     * Activite constructor.
     */
    public function __construct()
    {
        $this->activite = new ArrayCollection();
        $this->eleve = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getNbMax()
    {
        return $this->nbMax;
    }

    /**
     * @param mixed $nbMax
     */
    public function setNbMax($nbMax)
    {
        $this->nbMax = $nbMax;
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
     * @return ArrayCollection
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param ArrayCollection $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return ArrayCollection
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param ArrayCollection $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }



}