<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Secteur;
use App\Entity\Structure;
use App\Entity\SecteursStructures;


class StructDoctrineController extends AbstractController
{
    /**
     * @Route("/structures/doctrine", name="structures_doctrine")
     */
    //public function insert()
        public function insert(ManagerRegistry $doctrine)
    {
        //$em = $this->container->get('doctrine')->getManager();
        $em = $doctrine->getManager();

        $sante = new Secteur();
        $sante->setLibelle('Sante');
        $em->persist($sante);
        $em->flush();

        $sante->setLibelle('Santé');
        $em->persist($sante);
        $em->flush();

        $agro = new Secteur();
        $agro->setLibelle('Agroalimentaire');
        $em->persist($agro);
        $em->flush();
        $em->remove($agro);
        $em->flush();

        $sante=$em->getRepository('App\Entity\Secteur')->find(6);
        $sante->setLibelle('Tourisme');
        $em->flush();

        $aeronautique = new Secteur();
        $aeronautique->setLibelle('Aéronautique');
        $aerospatial = new Secteur();
        $aerospatial->setLibelle('Aérospatial');

        $structure=new Structure();
        $structure->setNom('EADS');
        $structure->setRue('rue EADS');
        $structure->setCp(31000);
        $structure->setVille('Toulouse');
        $structure->setEstasso(false);
        $structure->setNbActionnaires(100000);

        /*$em->persist($aeronautique);
        $em->persist($aerospatial);
        $em->persist($structure);
        $em->flush();*/

        // Création de $sectStruct avec en cascade $secteur et $structure
        $sectStruct=new SecteursStructures();
        $sectStruct->setIdSecteur($aeronautique);
        $sectStruct->setIdStructure($structure);
        $em->persist($sectStruct);
        $sectStruct2=new SecteursStructures();
        $sectStruct2->setIdSecteur($aerospatial);
        $sectStruct2->setIdStructure($structure);
        $em->persist($sectStruct2);
        $em->flush();

        return new Response(
            'SecteurStructure : idSectStruct1='.$sectStruct->getId().
            ', idSecteur1='.$sectStruct->getIdSecteur()->getId().
            ', idStructure1='.$sectStruct->getIdStructure()->getId().
            ', idSectStruct2='.$sectStruct2->getId().
            ', idSecteur2='.$sectStruct2->getIdSecteur()->getId().
            ', idStructure2='.$sectStruct2->getIdStructure()->getId()
        );
    }

}
