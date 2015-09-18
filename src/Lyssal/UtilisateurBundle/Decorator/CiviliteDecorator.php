<?php
namespace Lyssal\UtilisateurBundle\Decorator;

use Lyssal\StructureBundle\Decorator\DecoratorHandler;
use Lyssal\StructureBundle\Decorator\DecoratorHandlerInterface;
use Lyssal\UtilisateurBundle\Entity\Civilite;

/**
 * Helper de Civilite.
 * 
 * @author Rémi Leclerc
 */
class CiviliteDecorator extends DecoratorHandler implements DecoratorHandlerInterface
{
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Decorator\DecoratorHandlerInterface::supports()
     */
    public function supports($entity)
    {
        return ($entity instanceof Civilite);
    }
}
