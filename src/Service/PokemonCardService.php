<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\PokemonCard;
use App\Repository\PokemonCardRepository;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Service for handling Pokémon card related operations.
 */
class PokemonCardService
{
    private PokemonCardRepository $repository;
    private LoggerInterface $logger;

    public function __construct(PokemonCardRepository $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * Get all Pokémon cards.
     *
     * @return list<PokemonCard>
     * @throws InvalidArgumentException
     */
    public function getAllPokemonCards(): array
    {
        try {
            $pokemonCardDtoList = $this->repository->getPokemonCards();
        } catch (\RuntimeException $e) {
            $this->logger->error('Error fetching Pokémon cards: ' . $e->getMessage());
            throw new \RuntimeException('Unable to fetch Pokémon cards at this time.');
        }
        return PokemonCard::createListFromDtoList($pokemonCardDtoList);
    }

    /**
     * Get a Pokémon card by its ID.
     *
     * @param  string $id
     * @return PokemonCard|null
     * @throws InvalidArgumentException
     */
    public function getPokemonCardById(string $id): ?PokemonCard
    {
        try {
            $pokemonCardDto = $this->repository->getPokemonCardById($id);
        } catch (\RuntimeException $e) {
            $this->logger->error('Error fetching Pokémon cards: ' . $e->getMessage());
            throw new \RuntimeException('Unable to fetch the Pokémon card at this time.');
        }
        return PokemonCard::createFromDto($pokemonCardDto);
    }
}
