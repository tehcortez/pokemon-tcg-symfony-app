<?php

declare(strict_types=1);

namespace App\Model\PokemonCard;

use App\Dto\PokemonCardDto\ResistanceDto;

/**
 * Class representing a Pokémon Card Resistance.
 */
readonly class Resistance
{
    /**
     * Pokémon Card Resistance constructor.
     *
     * @param non-empty-string $type  The type of resistance, such as Fire or Water.
     * @param non-empty-string $value Value of the resistance
     */
    private function __construct(
        public string $type,
        public string $value,
    ) {
    }

    /**
     * Create a new instance of this class from the provided ResistanceDto.
     *
     * @param ResistanceDto $resistanceDto The data transfer object containing resistance information.
     */
    public static function createFromDto(ResistanceDto $resistanceDto): self
    {
        return new self(
            $resistanceDto->getType(),
            $resistanceDto->getValue(),
        );
    }

    /**
     * Creates a list of Resistance objects from the provided list of ResistanceDto objects.
     *
     * @param  list<ResistanceDto> $resistanceDtoList The list of ResistanceDto objects to create Resistance objects
     * from.
     * @return list<self> The list of Resistance objects created from the list of ResistanceDto objects.
     */
    public static function createListFromDtoList(array $resistanceDtoList): array
    {
        $resistanceList = [];
        foreach ($resistanceDtoList as $resistanceDto) {
            $resistanceList[] = self::createFromDto($resistanceDto);
        }
        return $resistanceList;
    }
}
