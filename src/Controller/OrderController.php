<?php


namespace App\Controller;


use App\Entity\OrderHead;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/orders_search", name="order_head_list", defaults={"page": 1}, requirements={"page"="\d+"}, methods={"POST"})
     */
    public function getOrdersHead($page = 1, Request $request)
    {
        $count = $request->get('count', 1);
        $repository = $this->getDoctrine()->getRepository(OrderHead::class);
        $items = $repository->findAll();

        return $this->json(
            [
                'count'   => $count,
                'data'    => $items
            ]
        );

    }

    /**
     * @Route("/orders/{id}", name="order_head_by_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOrderById(OrderHead $orderHead)
    {
        return $this->json($orderHead);
    }

}
