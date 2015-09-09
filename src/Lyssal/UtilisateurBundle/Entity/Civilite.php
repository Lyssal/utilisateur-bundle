<?php
namespace Lyssal\UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lyssal_civilite")
 * @ORM\MappedSuperclass
 */
abstract class Civilite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="civilite_id", type="smallint", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="civilite_abreviation", type="string", nullable=false, length=4)
     */
    private $abreviation;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="civilite_libelle", type="string", nullable=false, length=16)
     */
    private $libelle;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     * @return Civilite
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string 
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Civilite
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->libelle;
    }
}
