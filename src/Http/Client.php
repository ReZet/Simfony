<?php
declare(strict_types=1);

namespace App\Http;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class Client
{
    private $apiUrl;

    private $httpClient;
	
	public function __construct(HttpClientInterface $httpClient)
	{
		$this->httpClient = $httpClient;
	}
	
	public function request(String $path, Array $params): Array
	{
		$response = $this->httpClient->request(
			'GET', 
			$this->getApiUrl() . $path, 
			['query' => $params]
		);
		
		if ($response->getStatusCode() == 200) {
			return $response->toArray();
		} else {
			return [];
		}
		
	}

    public function setApiUrl(string $url): void
    {
        $this->apiUrl = $url;
    }

    public function getApiUrl(): string
    {
		if (empty($this->apiUrl)) {
			throw new \Exception('Api URL is empty');
		}
        return $this->apiUrl;
    }
}
