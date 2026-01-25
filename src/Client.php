<?php

declare(strict_types=1);

namespace ThomasNetScraper;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use ThomasNetScraper\DTO\Supplier;
use ThomasNetScraper\Exception\ApiException;
use ThomasNetScraper\Exception\InvalidQueryException;
use ThomasNetScraper\Exception\RateLimitException;

final class Client
{
    private HttpClient $http;

    private Config $config;

    public function __construct(string $apiToken, ?Config $config = null)
    {
        $this->config = $config ?? new Config($apiToken);
        $this->http = new HttpClient([
            'base_uri' => $this->config->baseUrl,
            'timeout' => $this->config->timeout,
            'headers' => [
                'Authorization' => 'Bearer '.$this->config->apiToken,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Search for suppliers.
     *
     * @return Supplier[]
     *
     * @throws ApiException
     * @throws RateLimitException
     * @throws InvalidQueryException
     */
    public function search(
        string $query,
        SearchMode $mode = SearchMode::All,
        ?Area $area = null,
        int $maxResults = 0,
    ): array {
        if (trim($query) === '') {
            throw new InvalidQueryException('Query cannot be empty');
        }

        $input = [
            'query' => $query,
            'mode' => $mode->value,
            'maxResults' => $maxResults,
        ];

        if ($area !== null) {
            $input['area'] = $area->value;
        }

        try {
            $response = $this->http->post(
                "/acts/{$this->config->actorId}/runs",
                [
                    'json' => $input,
                    'query' => ['waitForFinish' => $this->config->timeout],
                ]
            );

            $result = json_decode($response->getBody()->getContents(), true);

            if (! isset($result['data']['defaultDatasetId'])) {
                throw new ApiException('Invalid API response: missing dataset ID');
            }

            return $this->fetchDataset($result['data']['defaultDatasetId']);
        } catch (GuzzleException $e) {
            $this->handleGuzzleException($e);
        }
    }

    /**
     * @return Supplier[]
     *
     * @throws ApiException
     */
    private function fetchDataset(string $datasetId): array
    {
        try {
            $response = $this->http->get("/datasets/{$datasetId}/items");
            $items = json_decode($response->getBody()->getContents(), true);

            return array_map(
                static fn (array $item) => Supplier::fromArray($item),
                $items
            );
        } catch (GuzzleException $e) {
            throw new ApiException('Failed to fetch dataset: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws ApiException
     * @throws RateLimitException
     */
    private function handleGuzzleException(GuzzleException $e): never
    {
        $response = method_exists($e, 'getResponse') ? $e->getResponse() : null;

        if ($response !== null) {
            $statusCode = $response->getStatusCode();

            if ($statusCode === 429) {
                $retryAfter = (int) ($response->getHeader('Retry-After')[0] ?? 60);
                throw new RateLimitException('Rate limit exceeded', $retryAfter);
            }
        }

        throw new ApiException('API request failed: '.$e->getMessage(), 0, $e);
    }
}
