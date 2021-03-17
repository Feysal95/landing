<?php

declare(strict_types=1);

namespace App\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    
    public const LANDING_ID = '6051db900c4aff512a4cc073';
    
    /**
     * @return Response
     * @throws GuzzleException
     */
    public function index(): Response
    {
        $id = self::LANDING_ID;
        $client = new Client();
        $url = "https://hr-engine-backend.ams.kube.xbet.lan/external_api/landings/$id/blocks/";
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody()->getContents(), true);
        
        return $this->render('index.html.twig', [
            'list' => $data['list'] ?? []
        ]);
    }
}
