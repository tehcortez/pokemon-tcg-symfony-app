<?php

declare(strict_types=1);

namespace App\Tests;

use App\Collection\PokemonCardCollection;
use App\Dto\RepositoryResponseDto;
use App\Dto\RestClientApiResponseDto;
use App\Service\PokemonCardService;
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
        $pokemonCardCollection = PokemonCardCollection::createFromDtoList(
            new RepositoryResponseDto(1, [$this->pokemonCardUtility->getPokemonCardDtoTest()])
        );

        $this->pokemonCardService->method('getPokemonCardCollection')->willReturn($pokemonCardCollection);

        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('body', $pokemonCardCollection->getAllCards()[0]->name);
    }

    public function testListThrowsException(): void
    {
        $this->pokemonCardService->method('getPokemonCardCollection')->will(
            $this->throwException(new RuntimeException('RuntimeException error'))
        );

        $this->client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->assertSelectorTextContains('body', 'RuntimeException error');
    }
}
