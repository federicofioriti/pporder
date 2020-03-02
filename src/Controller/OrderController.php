<?php


namespace App\Controller;


use App\Entity\OrderHead;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/orders_search", name="order_head_list", defaults={"page": 1}, requirements={"page"="\d+"}, methods={"GET"})
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

    public function callByOrders($method, $url)
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request(
            $method,
            $url);

        $result [] = [
            'status'    => $response->getStatusCode()
        ];
        if ($response->getStatusCode() === Response::HTTP_OK)
        {
            $result += [
                'content'   => $response->getContent()
            ];
        }

        return $result;

    }

    /**
     * @Route("/consumer/orders", name="orders_consumer_search", methods={"GET"})
     */
    public function consumeByOrders(Request $request)
    {
        $url = $request->getScheme()
             . '://'
             . $request->server->get('HTTP_HOST')
             . $this->generateUrl('order_head_list');

        $items = $this->callByOrders('GET', $url);
        //$items = $this->curlChiamata('GET', $url);
        $count = $request->get('count', 1);
        return $this->json(
            [
                'count'   => $count,
                'data'    => $items
            ]
        );
    }

    /**
     * @Route("/consumer/orders/{id}", name="orders_consumer_by_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function consumeByOrderId(Request $request, $id)
    {
        $url = $request->getScheme()
            . '://'
            . $request->server->get('HTTP_HOST')
            . $this->generateUrl('order_head_by_id', [
                'id'   => $id
            ]);
        $items = $this->callByOrders('GET', $url);
        $count = $request->get('count', 1);
        return $this->json(
            [
                'count'   => $count,
                'data'    => $items
            ]
        );
    }

    /**
     * @Route("/prova", methods={"GET"}, name="prova")
     */
    public function prova(Request $request)
    {
        //$url = 'https://api.github.com/repos/symfony/symfony-docs';
        $url = 'http://localhost:8000/consumer/orders/7148252529';
        $method = 'GET';
        $items = $this->callByOrders($method, $url);

        return $this->json(
            [
                'count'   => 0,
                'data'    => $items
            ]
        );

    }

    public function curlChiamata($method, $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");

// Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close ($ch);

// Further processing ...
        if ($response == "OK")
        {
            return $response;
        } else
            {
                return false;
            }

    }
}
