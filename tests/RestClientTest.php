<?php
declare(strict_types=1);

namespace App\Tests;

use App\Client\RestClient;
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
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RestClientTest extends TestCase
{
    private HttpClientInterface $client;
    private LoggerInterface $logger;
    private RestClient $restClient;
    private PokemonCardTestUtility $pokemonCardUtility;

    protected function setUp(): void
    {
        $this->client = $this->createMock(HttpClientInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->restClient = new RestClient($this->client, $this->logger);
        $this->pokemonCardUtility = new PokemonCardTestUtility();
    }

    public function testGetCardList()
    {
        $url = 'https://api.example.com/cards';
        $response = $this->createMock(ResponseInterface::class);

        $responseData = json_decode($this->pokemonCardUtility->getPokemonCardListJsonData(), true);

        $response->method('getStatusCode')->willReturn(200);
        $response->method('toArray')->willReturn($responseData);

        $this->client->method('request')->with('GET', $url)->willReturn($response);

        $result = $this->restClient->getCardList($url);

        $this->assertInstanceOf(RestClientApiResponseDto::class, $result);
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals('OK', $result->getMessage());
        $this->assertEquals(1, $result->getPage());
        $this->assertEquals(250, $result->getPageSize());
        $this->assertEquals(1, $result->getCount());
        $this->assertEquals(1, $result->getTotalCount());
        $this->assertIsArray($result->getData());
    }

    public function testGetCardById()
    {
        $url = 'https://api.example.com/cards/pl3-143';
        $response = $this->createMock(ResponseInterface::class);

        $responseData = json_decode($this->pokemonCardUtility->getPokemonCardJsonData(), true);

        $response->method('getStatusCode')->willReturn(200);
        $response->method('toArray')->willReturn($responseData);

        $this->client->method('request')->with('GET', $url)->willReturn($response);

        $result = $this->restClient->getCardById($url);

        $pokemonCardDto = $this->pokemonCardUtility->getPokemonCardDtoTest();

        $this->assertInstanceOf(PokemonCardDto::class, $result);
        $this->assertEquals($pokemonCardDto->getId(), $result->getId());
        $this->assertEquals($pokemonCardDto->getName(), $result->getName());
        $this->assertEquals($pokemonCardDto->getTypes(), $result->getTypes());
        $this->assertEquals($pokemonCardDto->getImages(), $result->getImages());
        $this->assertEquals($pokemonCardDto->getWeaknesses(), $result->getWeaknesses());
        $this->assertEquals($pokemonCardDto->getResistances(), $result->getResistances());
        $this->assertEquals($pokemonCardDto->getAttacks(), $result->getAttacks());
    }

    public function testHandleErrorResponse()
    {
        $url = 'https://api.example.com/cards/pl3-143';
        $response = $this->createMock(ResponseInterface::class);

        $response->method('getStatusCode')->willReturn(404);
        $response->method('toArray')->willReturn(['error' => ['message' => 'Not Found']]);

        $this->client->method('request')->with('GET', $url)->willReturn($response);

        $this->expectException(NotFoundException::class);
        $this->restClient->getCardById($url);
    }
}
