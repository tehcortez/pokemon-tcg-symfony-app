<?php

declare(strict_types=1);

namespace App\Tests;

use App\Dto\PokemonCardDto;
use App\Dto\RepositoryResponseDto;
use App\Dto\RestClientApiResponseDto;
use PHPUnit\Framework\TestCase;
use App\Repository\PokemonCardRepository;
use App\Client\RestClient;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PokemonCardRepositoryTest extends TestCase
{
    private PokemonCardTestUtility $pokemonCardUtility;

    public function setUp(): void
    {
        $this->pokemonCardUtility = new PokemonCardTestUtility();
    }

    public function testGetPokemonCards()
    {
        // Mock dependencies
        $client = $this->createMock(RestClient::class);
        $cache = $this->createMock(CacheInterface::class);
        $apiUrl = 'https://api.example.com';

        // Mock the response from the $client
        $pokemonCardsData = [$this->pokemonCardUtility->getPokemonCardDtoTest()];

        $responseDto = new RestClientApiResponseDto(
            200,
            'OK',
            1,
            250,
            1,
            1,
            $pokemonCardsData
        );

        $client->method('getCardList')->willReturn($responseDto);

        // Mock the cache to return the expected data
        $cache->method('get')->willReturnCallback(
            function ($key, $callback) use ($pokemonCardsData) {
                $item = $this->createMock(ItemInterface::class);
                return $callback($item);
            }
        );

        // Create an instance of PokemonCardRepository with mocked dependencies
        $pokemonCardRepository = new PokemonCardRepository($client, $cache, $apiUrl);

        // Call the getPokemonCards method
        $repositoryResponseDto = $pokemonCardRepository->getPokemonCards();

        // Assert the expected result
        $this->assertInstanceOf(RepositoryResponseDto::class,$repositoryResponseDto);
        $this->assertCount(count($pokemonCardsData), $repositoryResponseDto->getPokemonCardDtoList());
        $this->assertInstanceOf(PokemonCardDto::class, $repositoryResponseDto->getPokemonCardDtoList()[0]);
    }

    public function testGetPokemonCardById()
    {
        // Mock dependencies
        $client = $this->createMock(RestClient::class);
        $cache = $this->createMock(CacheInterface::class);
        $apiUrl = 'https://api.example.com';

        // Mock the response from the $client
        $pokemonCardData = $this->pokemonCardUtility->getPokemonCardDtoTest();

        $client->method('getCardById')->willReturn($pokemonCardData);

        // Mock the cache to return the expected data
        $cache->method('get')->willReturnCallback(
            function ($key, $callback) use ($pokemonCardData) {
                $item = $this->createMock(ItemInterface::class);
                return $callback($item);
            }
        );

        // Create an instance of PokemonCardRepository with mocked dependencies
        $pokemonCardRepository = new PokemonCardRepository($client, $cache, $apiUrl);

        // Call the getPokemonCardById method
        $pokemonCard = $pokemonCardRepository->getPokemonCardById($pokemonCardData->getId());

        // Assert the expected result
        $this->assertInstanceOf(PokemonCardDto::class, $pokemonCard);
        $this->assertEquals($pokemonCardData->getId(), $pokemonCard->getId());
        $this->assertEquals($pokemonCardData->getName(), $pokemonCard->getName());
    }
}
