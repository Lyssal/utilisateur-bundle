<?php
namespace Lyssal\UtilisateurBundle\Decorator;

use Lyssal\StructureBundle\Decorator\DecoratorHandler;
use Lyssal\StructureBundle\Decorator\DecoratorHandlerInterface;
use Lyssal\UtilisateurBundle\Entity\UtilisateurGroupe;

/**
 * Helper de UtilisateurGroupe.
 * 
 * @author Rémi Leclerc
 */
class UtilisateurGroupeDecorator extends DecoratorHandler implements DecoratorHandlerInterface
{
    /**
     * (non-PHPdoc)
     * @see \Lyssal\StructureBundle\Decorator\DecoratorHandlerInterface::supports()
     */
    public function supports($entity)
    {
        return ($entity instanceof UtilisateurGroupe);
    }
}
