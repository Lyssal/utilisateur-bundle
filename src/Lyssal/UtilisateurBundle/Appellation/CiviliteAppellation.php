<?php
namespace Lyssal\UtilisateurBundle\Appellation;

use Lyssal\StructureBundle\Appellation\AppellationHandlerInterface;
use Lyssal\StructureBundle\Appellation\AppellationHandler;
use Lyssal\UtilisateurBundle\Entity\Civilite;
use Lyssal\UtilisateurBundle\Decorator\CiviliteDecorator;

class CiviliteAppellation extends AppellationHandler implements AppellationHandlerInterface
{
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::pays()
     */
    public function supports($object)
    {
        return ($object instanceof Civilite || $object instanceof CiviliteDecorator);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::appellation()
     */
    public function appellation($civilite)
    {
        return $civilite->__toString();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::appellationHtml()
     */
    public function appellationHtml($civilite)
    {
        return $this->appellation($civilite);
    }
}
