<?php

declare(strict_types=1);

namespace App\Model;

use App\Dto\PokemonCardDto;
use App\Model\PokemonCard\Attack;
use App\Model\PokemonCard\Images;
use App\Model\PokemonCard\Resistance;
use App\Model\PokemonCard\Weakness;

readonly class PokemonCard
{
    /**
     * Constructor for the PokemonCard class.
     *
     * @param string                 $name
     * @param string                 $id
     * @param list<non-empty-string> $types
     * @param Images                 $images
     * @param list<Resistance>       $resistances
     * @param list<Weakness>         $weaknesses
     * @param list<Attack>           $attacks
     */
    private function __construct(
        public string $name,
        public string $id,
        public array $types,
        public Images $images,
        public array $resistances,
        public array $weaknesses,
        public array $attacks,
    ) {
    }

    /**
     * Creates an array of PokemonCard objects from the provided list of PokemonCardDto objects.
     *
     * @param  list<PokemonCardDto> $pokemonCardDtoList The list of PokemonCardDto objects to create PokemonCard
     *                                                  objects from.
     * @return list<self> The list of PokemonCard objects created from the list of PokemonCardDto objects.
     */
    public static function createListFromDtoList(array $pokemonCardDtoList): array
    {
        $pokemonCardList = [];
        foreach ($pokemonCardDtoList as $pokemonCardDto) {
            $pokemonCardList[] = self::createFromDto($pokemonCardDto);
        }
        return $pokemonCardList;
    }

    public static function createFromDto(PokemonCardDto $pokemonCardDto): self
    {
        return new self(
            $pokemonCardDto->getName(),
            $pokemonCardDto->getId(),
            $pokemonCardDto->getTypes(),
            Images::createFromDto($pokemonCardDto->getImages()),
            Resistance::createListFromDtoList($pokemonCardDto->getResistances()),
            Weakness::createListFromDtoList($pokemonCardDto->getWeaknesses()),
            Attack::createListFromDtoList($pokemonCardDto->getAttacks()),
        );
    }
}
