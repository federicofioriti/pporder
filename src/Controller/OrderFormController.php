<?php

namespace App\Controller;

use App\Entity\OrderHead;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderFormController extends AbstractController
{
    /**
     * @Route("/orders/list", name="orders_list")
     */
    public function listOrders(Request $request)
    {
        $orders = $this->getDoctrine()
            ->getRepository(OrderHead::class)
            ->findAll();

        return $this->render('orders/list.html.twig', [
            'orders'   => $orders
        ]);
    }

    /**
     * @Route("/orders/update/{id}", name="orders_update")
     */
    public function updateAction(Request $request, $id)
    {
        // fetch order by id
        $order = $this->getDoctrine()->getManager()
            ->getRepository(OrderHead::class)
            ->find($id);

        // rendering form and load into data
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $repository = $this->getDoctrine()->getManager();
            $order = $repository->getRepository('App:OrderHead')
                ->find($id);
            $repository->persist($order);
            $repository->flush();

            return $this->redirectToRoute('orders_list');
        }

        return $this->render('orders/update.html.twig', [
            'order'   => $order,
            'form'    => $form->createView()
        ]);
    }

    /**
     * @Route("/orders/delete/{id}", name="orders_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $repo = $this->getDoctrine()->getManager();
        $order = $repo->getRepository(OrderHead::class)->find($id);

        if ($order)
        {
            $repo->remove($order);
            $repo->flush();
        }

        return $this->redirectToRoute('orders_list');
    }
}
