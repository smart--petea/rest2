<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client as HttpClient;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        if(!$this->get('session')->has('geodata')) {
            $httpResponse = (new HttpClient())->get('http://api.ipstack.com/'.'94.139.138.228'.'?access_key=246cc7ab52f78603ca450b486417b339');
            $geodata = json_decode($httpResponse->getBody()->getContents(), true);

            $this->get('session')->set('geodata', $geodata);
        } else {
            $geodata = $this->get('session')->get('geodata');
        }

        return $this->render('default/index.html.twig', $geodata);
    }
}
