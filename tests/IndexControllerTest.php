<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\PokemonCardService;
use App\Model\PokemonCard;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends WebTestCase
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

    public function testList(): void
    {
        $pokemonCardList = [
            $this->pokemonCardUtility->getPokemonCardModelTest(),
        ];

        $this->pokemonCardService->method('getAllPokemonCards')->willReturn($pokemonCardList);

        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('body', $pokemonCardList[0]->name);
    }

    public function testListThrowsException(): void
    {
        $this->pokemonCardService->method('getAllPokemonCards')->will(
            $this->throwException(new RuntimeException('RuntimeException error'))
        );

        $this->client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertSelectorTextContains('body', 'RuntimeException error');
    }
}
