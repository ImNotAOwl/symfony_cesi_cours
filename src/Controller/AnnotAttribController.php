<?php

namespace App\Controller;

use App\Operations\Operation;
use App\Service\HorlogeService;
use App\Service\InfosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnotAttribController extends AbstractController
{
    #[Route('/annot/attrib/{name}', name: 'app_annot_attrib')]
    public function index(Request $req): Response
    {
        $name = $req->get('name');

        return $this->render('annot_attrib/index.html.twig', [
            'controller_name' => 'AnnotAttribController',
            'name' => $name
        ]);
    }

    #[Route(path: '/annot/getpost', name: 'annot_getpost_params')]
    public function displayGetPostParams(Request $req) : Response
    {
        /*return new Response(
            'pp1='.$_POST['pp1'].', pp2='.$_POST['pp2'].
            ', pp3='.$_POST['pp3'].', pg1='.$_GET['pg1']
            .', pg2='.$_GET['pg2']
        );*/

        // GET
        $pget1 = $req->query->get('pg1');
        $pget2 = $req->query->get('pg2');

        // POST
        $ppost1 = $req->request->get('pp1');
        $ppost2 = $req->request->get('pp2');
        $ppost3 = $req->request->get('pp3');
        $ppost4 = implode(',', $req->request->all());

        return new Response(
            "Paramètres du get et du post : pg1=$pget1, pg2=$pget2, 
            pp1=$ppost1, pp2=$ppost2, pp3=$ppost3, pp4=$ppost4" );
    }

    #[Route(path: '/ope/annot/redirect', name: 'ope_annot_redirect')]
    public function calculRedirect(Request $req) : Response {
        /*return $this->redirectToRoute('ope_annot_calcul',
            ['op'=>'div','val1'=>1,'val2'=>2]);*/

        $v1 = $req->query->get('val1');
        $v2 = $req->query->get('val2');
        $o = $req->query->get('op');

        return $this->redirectToRoute('ope_yaml_calcul',
            ['op'=>$o,'val1'=>$v1,'val2'=>$v2]);
    }

    #[Route(path: '/attrib/horloge', name: 'attrib_horloge')]
    public function viewHorloge(HorlogeService $horlogeService)
    {
        return new Response($horlogeService->getHorloge());
    }

    #[Route(path: '/annot/infos', name: 'annot_infos')]
    public function viewInfos(InfosService $infosService)
    {
        return new Response($infosService->getInfos());
        // pour afficher la valeur du paramètre host (config/services.yaml)
        //return new Response($this->getParameter('host'));
    }

    #[Route(path: '/opeform/attrib', name: 'ope_attrib_form')]
    public function form(Request $request) : Response
    {
        $operation = new Operation();
        $form = $this->createFormBuilder($operation,array())
            ->add('val1', NumberType::class)
            ->add('op', ChoiceType::class,
                array('choices'=>array('+'=>'plus','-'=>'moins','*'=>'mult','/'=>'div')))
            ->add('val2', NumberType::class)
            ->add('calculer', SubmitType::class, array('label' => 'Calculer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operation = $form->getData();
            return $this->redirectToRoute('ope_annot_calcul',
                array('val1'=>$operation->getVal1(),
                    'op'=>$operation->getOp(),
                    'val2'=>$operation->getVal2()));
        }

        return $this->render('operations/form.operation.html.twig',
            array('formulaire' => $form->createView()));
    }
    
}
