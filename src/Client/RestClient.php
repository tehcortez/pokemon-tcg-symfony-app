<?php

declare(strict_types=1);

namespace App\Client;

use App\Dto\PokemonCardDto;
use App\Dto\RestClientApiResponseDto;
use App\Exception\BadRequestException;
use App\Exception\BadResponseException;
use App\Exception\DecodingException;
use App\Exception\ForbiddenException;
use App\Exception\HttpRequestException;
use App\Exception\NotFoundException;
use App\Exception\RequestFailedException;
use App\Exception\ServerErrorException;
use App\Exception\TooManyRequestsException;
use App\Mapper\PokemonCardDtoMapper;
use RuntimeException;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class for handling HTTP requests.
 */
class RestClient
{
    private HttpClientInterface $client;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Perform a GET request.
     *
     * @param  non-empty-string $url
     * @return RestClientApiResponseDto
     */
    public function getCardList(string $url): RestClientApiResponseDto
    {
        try {
            $response = $this->client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            $data = null;

            if ($statusCode === 200) {
                $data = $response->toArray();
            } else {
                $this->handleErrorResponse($response);
            }

            if (
                !isset($data['page'])
                || !isset($data['pageSize'])
                || !isset($data['count'])
                || !isset($data['totalCount'])
                || !isset($data['data'])
            ) {
                throw new BadResponseException('Unprocessable Entity: Bad JSON');
            }
            $page = $data['page'];
            $pageSize = $data['pageSize'];
            $count = $data['count'];
            $totalCount = $data['totalCount'];
            $data = PokemonCardDtoMapper::mapCardList($data['data']);
            return new RestClientApiResponseDto(
                $statusCode,
                'OK',
                $page,
                $pageSize,
                $count,
                $totalCount,
                $data
            );
        } catch (
            ClientExceptionInterface |
            RedirectionExceptionInterface |
            ServerExceptionInterface |
            TransportExceptionInterface $e
        ) {
            $this->logger->error('HTTP request failed: ' . $e->getMessage());
            throw new HttpRequestException('Unable to perform HTTP request at this time.');
        } catch (DecodingExceptionInterface $e) {
            $this->logger->error('Content-type cannot be decoded: ' . $e->getMessage());
            throw new DecodingException('Content-type cannot be decoded to the expected representation.');
        }
    }

    /**
     * Perform a GET request.
     *
     * @param  non-empty-string $url
     * @return PokemonCardDto
     */
    public function getCardById(string $url): PokemonCardDto
    {
        try {
            $response = $this->client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            $data = null;

            if ($statusCode === 200) {
                $data = $response->toArray();
            } else {
                $this->handleErrorResponse($response);
            }

            if (!isset($data['data'])) {
                throw new BadResponseException('Unprocessable Entity: Bad JSON');
            }
            return PokemonCardDtoMapper::mapCard($data['data']);
        } catch (
            ClientExceptionInterface |
            RedirectionExceptionInterface |
            ServerExceptionInterface |
            TransportExceptionInterface $e
        ) {
            $this->logger->error('HTTP request failed: ' . $e->getMessage());
            throw new HttpRequestException('Unable to perform HTTP request at this time.');
        } catch (DecodingExceptionInterface $e) {
            $this->logger->error('Content-type cannot be decoded: ' . $e->getMessage());
            throw new DecodingException('Content-type cannot be decoded to the expected representation.');
        }
    }

    /**
     * Handle error responses from the API.
     *
     * @param  ResponseInterface $response
     * @throws RuntimeException
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     */
    private function handleErrorResponse(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        $error = $response->toArray(false)['error'] ?? null;
        $message = $error['message'] ?? 'An error occurred';

        switch ($statusCode) {
            case 400:
                throw new BadRequestException('Bad Request: ' . $message);
            case 402:
                throw new RequestFailedException('Request Failed: ' . $message);
            case 403:
                throw new ForbiddenException('Forbidden: ' . $message);
            case 404:
                throw new NotFoundException('Not Found: ' . $message);
            case 429:
                throw new TooManyRequestsException('Too Many Requests: ' . $message);
            default:
                $this->logger->error('API Server Error: ' . $message);
                throw new ServerErrorException('Server Error: ' . $message);
        }
    }
}
