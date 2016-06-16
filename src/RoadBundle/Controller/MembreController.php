<?php


namespace RoadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RoadBundle\Form\MembreType;
use RoadBundle\Entity\Membre;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;


class MembreController extends Controller
{
    public function getMembreAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('RoadBundle:Membre')->findOneByIDgroupe($id);

        return array('membre' => '$membre');
    }

    public function newMembreAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $membre = new Membre();
        $form = $this->createForm('RoadBundle\Form\MembreType', $membre);
        $form->handleRequest($request);
        $jsonData = json_decode($request->getContent(), true); // "true" to get an associative array
        $form->bind($jsonData);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $membre->setIdgroupe($id);
            $em->persist($membre);
            $em->flush();

            return array('membre' => $membre);

        }
        return View::create($form, 400);
    }
    public function updateBudgetAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $membre = $em->getRepository('RoadBundle:Membre')->findOneByIdgroupe($id);

        $editForm = $this->createForm('RoadBundle\Form\MembreType', $membre);

        $jsonData = json_decode($request->getContent(), true); // "true" to get an associative array

        $editForm->bind($jsonData);
        if ($membre) {
            if ($editForm->isValid()) {
                $membre->setIdgroupe($id);
                $em->persist($membre);
                $em->flush();

                return array('membre' => $membre);
            } else {
                return View::create($editForm, 400);
            }
        } else {
            throw $this->createNotFoundException('Membre not found!');
        }
    }
}