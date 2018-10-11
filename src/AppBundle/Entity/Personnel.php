<?php
/**
 * Created by PhpStorm.
 * User: ileft
 * Date: 16/09/2018
 * Time: 15:01
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="personnel")
 */
class Personnel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="cin" ,type="string",length= 8, unique=true)
     * @Assert\Type(
     *     type="integer",
     *     message="Le valeur {{ value }} n'est pas de type {{ type }} ou le longeur est supérieur à 8."
     * )
     */
    protected $CIN;
    /**
     * @ORM\Column( name="nom",type="string")
     */
    protected $nom;
    /**
     * @ORM\Column(name="prenom",type="string")
     */
    protected $prenom;
    /**
     * @ORM\Column(name="date_naiss", type="string")
     */
    protected $dateNaiss;


    /**
     * @ORM\Column(name="num_tel",type="string")
     * @Assert\Type(
     *     type="integer",
     *     message="Le valeur {{ value }} n'est pas de type {{ type }} ou le longeur est supérieur à 8."
     * )
     */
    protected $numtel;



    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     */
    private $image = "";

    /**
     * @var  ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Salaire", mappedBy="personnel")
     */
    private $salaire;

    /**
     * Activite constructor.
     */
    public function __construct()
    {
        $this->salaire = new ArrayCollection();
    }





    /**
     * @return mixed
     */
    public function getCIN()
    {
        return $this->CIN;
    }

    /**
     * @param mixed $CIN
     */
    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * @param mixed $dateNaiss
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;
    }


    /**
     * @return mixed
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param mixed $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * @param ArrayCollection $salaire
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;
    }




}