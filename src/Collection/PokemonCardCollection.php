<?php

declare(strict_types=1);

namespace App\Collection;

use App\Dto\RepositoryResponseDto;
use App\Model\PokemonCard;
use InvalidArgumentException;

class PokemonCardCollection
{
    /** @var array<string, PokemonCard> */
    private array $cards = [];

    /**
     * @var non-negative-int
     */
    private int $totalCardsCount = 0;

    /**
     * @param non-negative-int $totalCardsCount
     */
    private function __construct(int $totalCardsCount) {
        $this->totalCardsCount = $totalCardsCount;
    }

    /**
     * Creates a new instance of the collection class from a list of PokemonCardDto objects.
     *
     * @return self The newly created instance of the class.
     */
    public static function createFromDtoList(RepositoryResponseDto $pokemonCardDtoList): self
    {
        $collection = new self($pokemonCardDtoList->getTotalCount());
        foreach ($pokemonCardDtoList->getPokemonCardDtoList() as $dto) {
            $collection->addCard(PokemonCard::createFromDto($dto));
        }
        return $collection;
    }

    /**
     * Add a Pokemon card to the collection.
     *
     * @param PokemonCard $card
     */
    public function addCard(PokemonCard $card): void
    {
        $this->cards[$card->id] = $card;
    }

    /**
     * Remove a Pokemon card from the collection by its ID.
     *
     * @param string $id
     * @throws InvalidArgumentException if the card ID does not exist.
     */
    public function removeCardById(string $id): void
    {
        if (!isset($this->cards[$id])) {
            throw new InvalidArgumentException("Card with ID $id does not exist in the collection.");
        }

        unset($this->cards[$id]);
    }

    /**
     * Get a Pokemon card by its ID.
     *
     * @param string $id
     * @return PokemonCard|null
     */
    public function getCardById(string $id): ?PokemonCard
    {
        return $this->cards[$id] ?? null;
    }

    /**
     * Get all Pokemon cards in the collection.
     *
     * @return list<PokemonCard>
     */
    public function getAllCards(): array
    {
        return array_values($this->cards);
    }

    /**
     * Get the count of Pokemon cards in the collection.
     *
     * @return non-negative-int
     */
    public function getCardCount(): int
    {
        return count($this->cards);
    }

    /**
     * Get the total count of Pokemon cards in the API.
     *
     * @return non-negative-int
     */
    public function getTotalCardsCount(): int
    {
        return $this->totalCardsCount;
    }
}
