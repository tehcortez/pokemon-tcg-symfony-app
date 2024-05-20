<?php

declare(strict_types=1);

namespace App\Repository;

use App\Client\RestClient;
use App\Dto\PokemonCardDto;
use App\Mapper\PokemonCardDtoMapper;
use Psr\Cache\InvalidArgumentException;
use RuntimeException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * Repository for fetching Pokémon card data.
 */
class PokemonCardRepository
{
    private RestClient $client;
    private CacheInterface $cache;
    private string $apiUrl;

    public function __construct(RestClient $client, CacheInterface $cache, string $apiUrl)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Get a list of Pokémon cards.
     *
     * @param  positive-int $page
     * @return list<PokemonCardDTO>
     * @throws InvalidArgumentException
     */
    public function getPokemonCards(int $page = 1): array
    {
        return $this->cache->get(
            'pokemon_cards_page_' . $page,
            function (ItemInterface $item) use ($page) {
                $item->expiresAfter(3600); // Cache for 1 hour = 3600
                $responseDto = $this->client->getCardList($this->apiUrl . '/cards?page=' . $page);

                if ($responseDto->getStatusCode() !== 200) {
                    throw new RuntimeException('Failed to fetch Pokémon cards: ' . $responseDto->getMessage());
                }
                return $responseDto->getData();
            }
        );
    }

    /**
     * Get a Pokémon card by its ID.
     *
     * @param  string $id
     * @return PokemonCardDto|null
     * @throws InvalidArgumentException
     */
    public function getPokemonCardById(string $id): ?PokemonCardDto
    {
        return $this->cache->get(
            'pokemon_card_' . $id,
            function (ItemInterface $item) use ($id) {
                $item->expiresAfter(3600); // Cache for 1 hour
                return $this->client->getCardById($this->apiUrl . '/cards/' . $id);
            }
        );
    }
}
