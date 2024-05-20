<?php

declare(strict_types=1);

namespace App\Tests;

use App\Model\PokemonCard;
use App\Repository\PokemonCardRepository;
use App\Service\PokemonCardService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Cache\InvalidArgumentException;
use RuntimeException;

class PokemonCardServiceTest extends TestCase
{
    private $repository;
    private $logger;
    private $pokemonCardService;
    private PokemonCardTestUtility $pokemonCardUtility;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(PokemonCardRepository::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->pokemonCardService = new PokemonCardService($this->repository, $this->logger);
        $this->pokemonCardUtility = new PokemonCardTestUtility();
    }

    public function testGetAllPokemonCards()
    {
        $pokemonCardDtoList = [
            $this->pokemonCardUtility->getPokemonCardDtoTest(),
            $this->pokemonCardUtility->getPokemonCardDtoTest(),
        ];

        $this->repository->method('getPokemonCards')->willReturn($pokemonCardDtoList);

        $pokemonCards = $this->pokemonCardService->getAllPokemonCards();

        $this->assertIsArray($pokemonCards);
        $this->assertCount(2, $pokemonCards);
        $this->assertInstanceOf(PokemonCard::class, $pokemonCards[0]);
    }

    public function testGetAllPokemonCardsThrowsException()
    {
        $this->repository->method('getPokemonCards')->will($this->throwException(new RuntimeException('Some error')));

        $this->logger->expects($this->once())
            ->method('error')
            ->with('Error fetching Pokémon cards: Some error');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to fetch Pokémon cards at this time.');

        $this->pokemonCardService->getAllPokemonCards();
    }

    public function testGetPokemonCardById()
    {
        $pokemonCardDto = $this->pokemonCardUtility->getPokemonCardDtoTest();

        $this->repository->method('getPokemonCardById')->willReturn($pokemonCardDto);

        $pokemonCard = $this->pokemonCardService->getPokemonCardById('xy7-54');

        $this->assertInstanceOf(PokemonCard::class, $pokemonCard);
    }

    public function testGetPokemonCardByIdThrowsException()
    {
        $this->repository->method('getPokemonCardById')->will($this->throwException(new RuntimeException('Some error')));

        $this->logger->expects($this->once())
            ->method('error')
            ->with('Error fetching Pokémon cards: Some error');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to fetch the Pokémon card at this time.');

        $this->pokemonCardService->getPokemonCardById('xy7-54');
    }
}
