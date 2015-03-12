<?php
namespace Lyssal\UtilisateurBundle\Entity;

use FOS\UserBundle\Entity\Group as AbstractedGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lyssal_utilisateur_groupe")
 * @ORM\MappedSuperclass
 */
abstract class UtilisateurGroupe extends AbstractedGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Represents a string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ?: '';
    }
}
