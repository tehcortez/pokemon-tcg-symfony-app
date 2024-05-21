<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\PokemonCardService;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PokemonCardControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PokemonCardService $pokemonCardService;
    private PokemonCardTestUtility $pokemonCardUtility;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->pokemonCardService = $this->createMock(PokemonCardService::class);
        self::getContainer()->set(PokemonCardService::class, $this->pokemonCardService);
        $this->pokemonCardUtility = new PokemonCardTestUtility();
    }

    public function testDetail(): void
    {
        $pokemonCard = $this->pokemonCardUtility->getPokemonCardModelTest();

        $this->pokemonCardService->method('getPokemonCardById')->willReturn($pokemonCard);

        $this->client->request('GET', '/card/' . $pokemonCard->id);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('body', $pokemonCard->name);
    }

    public function testDetailNotFound(): void
    {
        $this->pokemonCardService->method('getPokemonCardById')->willReturn(null);

        $this->client->request('GET', '/card/xy7-5004');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
        $this->assertSelectorTextContains('body', 'The Pokémon card does not exist');
    }

    public function testDetailThrowsException(): void
    {
        $this->pokemonCardService->method('getPokemonCardById')->will(
            $this->throwException(new RuntimeException('Some error'))
        );

        $this->client->request('GET', '/card/xy7-54');

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertSelectorTextContains('body', 'Some error');
    }
}
