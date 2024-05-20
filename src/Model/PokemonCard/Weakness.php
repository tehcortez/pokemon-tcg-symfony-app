<?php

declare(strict_types=1);

namespace App\Model\PokemonCard;

use App\Dto\PokemonCardDto\WeaknessDto;

/**
 * Class representing a Pokémon Card weakness.
 */
readonly class Weakness
{
    /**
     * Weakness constructor.
     *
     * @param non-empty-string $type  The type of weakness, such as Fire or Water.
     * @param non-empty-string $value The value of the weakness.
     */
    public function __construct(
        public string $type,
        public string $value,
    ) {
    }

    /**
     * Create a new instance of this class from the provided WeaknessDto.
     *
     * @param WeaknessDto $weaknessDto The data transfer object containing weakness information.
     */
    public static function createFromDto(WeaknessDto $weaknessDto): self
    {
        return new self(
            $weaknessDto->getType(),
            $weaknessDto->getValue(),
        );
    }

    /**
     * Creates a list of Weakness objects from the provided list of WeaknessDto objects.
     *
     * @param  list<WeaknessDto> $weaknessDtoList The list of WeaknessDto objects to create Weakness objects from.
     * @return list<self> The list of Weakness objects created from the list of WeaknessDto objects.
     */
    public static function createListFromDtoList(array $weaknessDtoList): array
    {
        $weaknessList = [];
        foreach ($weaknessDtoList as $weaknessDto) {
            $weaknessList[] = self::createFromDto($weaknessDto);
        }
        return $weaknessList;
    }
}
