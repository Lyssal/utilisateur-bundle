<?php
namespace Lyssal\UtilisateurBundle\Appellation;

use Lyssal\StructureBundle\Appellation\AppellationHandlerInterface;
use Lyssal\StructureBundle\Appellation\AppellationHandler;
use Lyssal\UtilisateurBundle\Entity\UtilisateurGroupe;
use Lyssal\UtilisateurBundle\Decorator\UtilisateurGroupeDecorator;

class UtilisateurGroupeAppellation extends AppellationHandler implements AppellationHandlerInterface
{
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::pays()
     */
    public function supports($object)
    {
        return ($object instanceof UtilisateurGroupe || $object instanceof UtilisateurGroupeDecorator);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::appellation()
     */
    public function appellation($object)
    {
        return $object->__toString();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Appellation\AppellationHandlerInterface::appellationHtml()
     */
    public function appellationHtml($object)
    {
        return $this->appellation($object);
    }
}
