<?php

declare(strict_types=1);

namespace App\Resource;

use App\Collection\PokemonCardCollection;

class PokemonCardCollectionResource
{
    private function __construct(
        private array $data,
        private int $page,
        private int $pageSize,
        private int $totalItems,
        private int $totalPages
    ) {
    }

    /**
     * Creates a new instance of the PokemonCardCollectionResource class from a PokemonCardCollection object and a page
     * number.
     *
     * @param PokemonCardCollection $pokemonCardCollection The collection of Pokemon cards.
     * @param positive-int $page The page number.
     * @return self The newly created PokemonCardCollectionResource object.
     */
    public static function createFromCollection(PokemonCardCollection $pokemonCardCollection, int $page): self
    {
        $data = [];
        foreach ($pokemonCardCollection->getAllCards() as $pokemonCard) {
            $data[] = [
                'name' => $pokemonCard->name,
                'id' => $pokemonCard->id,
                'types' => $pokemonCard->types,
                'images' => $pokemonCard->images,
                'resistances' => $pokemonCard->resistances,
                'weaknesses' => $pokemonCard->weaknesses,
                'attacks' => $pokemonCard->attacks,
            ];
        }
        return new self(
            $data,
            $page,
            250,
            $pokemonCardCollection->getTotalCardsCount(),
            intval(ceil($pokemonCardCollection->getTotalCardsCount() / 250))
        );
    }

    /**
     * Returns an array representation of the object, including the data and meta information.
     *
     * @return array<string, mixed> The array representation of the object.
     */
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'meta' => [
                'page' => $this->page,
                'pageSize' => $this->pageSize,
                'totalItems' => $this->totalItems,
                'totalPages' => $this->totalPages,
            ],
        ];
    }
}
