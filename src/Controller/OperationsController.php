<?php

namespace App\Controller;

use App\Service\InfosService;
use App\Service\OperationsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperationsController extends AbstractController
{
    public function yamlHome(): Response
    {
        return $this->render('operations/index.html.twig', [
            'controller_name' => 'OperationsController',
        ]);
    }

    public function calculYaml(float $val1, float $val2, string $op): Response
    {
        return new Response('Calcul Yaml : val1=' . $val1 . ', val2=' . $val2 . ', op=' . $op);
    }

    #[Route(path: '/ope/attrib/{val1}/{op}/{val2}', name: 'ope_attrib_calcul', requirements: ['val1' => '-?\d+\.?\d*', 'val2' => '-?\d+\.?\d*', 'op' => 'plus|moins|mult|div'])]
    public function calculAttrib(float $val2, float $val1, string $op, InfosService $is): Response
    {
        //return new Response('Calcul Annot : val1='.$val1.', val2='.$val2.', op='.$op);
        return new Response($is->getInfos() . '</br>' . $val1 . ' ' . $op . ' ' . $val2 . ' = ' . $this->calcul($val1, $val2, $op));
    }

    #[Route(path: '/ope/annot/{val1}/{op}/{val2}', name: 'ope_annot_calcul', requirements: ['val1' => '-?\d+\.?\d*', 'val2' => '-?\d+\.?\d*', 'op' => 'plus|moins|mult|div'])]
    public function calculAnnot(float $val2, float $val1, string $op): Response
    {

        //return new Response('Calcul Annot : val1='.$val1.', val2='.$val2.', op='.$op);
        return new Response($val1 . ' ' . $op . ' ' . $val2 . ' = ' . $this->calcul($val1, $val2, $op));
    }

    public function calcul(float $nb1, float $nb2, string $op): string
    {
        switch ($op) {
            case 'plus':
                $res = $nb1 + $nb2;
                break;
            case 'moins':
                $res = $nb1 - $nb2;
                break;
            case 'mult':
                $res = $nb1 * $nb2;
                break;
            case 'div':
                if ($nb2 == 0) {
                    $res = 'Division par zéro impossible';
                } else {
                    $res = $nb1 / $nb2;
                }
                break;
            default:
                $res = 'Mauvais opérateur';
                break;
        }
        return $res;
    }

    #[Route(path: '/opeservice/annot/{val1}/{op}/{val2}', name: 'ope_annot_calcul_service', requirements: ['val1' => '-?\d+\.?\d*', 'val2' => '-?\d+\.?\d*', 'op' => 'plus|moins|mult|div'])]
    public function calculAnnotService(
        float $val2,
        float $val1,
        string $op,
        OperationsService $opService
    ): Response {
        return new Response('Résultat Annot avec service: ' . $opService->calcul($val1, $val2, $op));
    }

    #[Route(path: '/opetwig/annot/{val1}/{op}/{val2}', name: 'ope_annot_calcul_twig', requirements: ['val1' => '-?\d+\.?\d*', 'val2' => '-?\d+\.?\d*', 'op' => 'plus|moins|mult|div'])]
    public function calculTwig(float $val1, string $op, float $val2): Response
    {
        return $this->render('operations/operation.html.twig', [
            'v1' => $val1, 'v2' => $val2, 'operateur' => $op
        ]);
    }
}
