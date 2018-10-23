<?php
declare(strict_types=1);

namespace Latanskaya\Gatherer\Service;

use GuzzleHttp\Client;

class GuzzleTransporter implements Transporter
{
    protected $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client();
    }

    public function getResponse($uri = '')
    {
        try {
            $response = $this->client->request('GET', $uri);

            #TODO: work with unsuccessfull response codes
            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
