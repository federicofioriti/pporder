<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route(name="homepage", path="/homepage")
     */
    public function homepage(Request $request)
    {
        return new Response('<h3> Ciao</h3>');

    }
}
