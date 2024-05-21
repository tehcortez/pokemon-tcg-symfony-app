<?php

declare(strict_types=1);

namespace App\Model\PokemonCard;

use App\Dto\PokemonCardDto\AttackDto;

/**
 * Class representing a Pokémon card Attack. Attacks are skills that a Pokémon card can use in the Pokémon Trading Card
 * Game, which are similar to moves in the video games. Nearly every Pokémon card has at least one attack.
 */
readonly class Attack
{
    /**
     * Pokémon Card Attack constructor.
     *
     * @param list<non-empty-string> $cost                The cost of the attack represented by a list of energy types.
     * @param non-empty-string       $name                The name of the attack.
     * @param non-empty-string       $text                The text or description associated with the attack.
     * @param non-empty-string|null  $damage              The damage amount of the attack.
     * @param int                    $convertedEnergyCost The total cost of the attack in terms of converted energy.
     */
    private function __construct(
        public array $cost,
        public string $name,
        public string $text,
        public ?string $damage,
        public int $convertedEnergyCost,
    ) {
    }

    /**
     * Create an instance of this class from the provided AttackDto object.
     *
     * @param AttackDto $attackDto The AttackDto object to create the Attack instance from
     */
    public static function createFromDto(AttackDto $attackDto): self
    {
        return new self(
            $attackDto->getCost(),
            $attackDto->getName(),
            $attackDto->getText(),
            $attackDto->getDamage(),
            $attackDto->getConvertedEnergyCost(),
        );
    }

    /**
     * Creates a list of Attack objects from the provided list of AttackDto objects.
     *
     * @param  list<AttackDto> $attackDtoList The list of AttackDto objects to create Attack objects from.
     * @return list<self> The list of Attack objects created from the list of AttackDto objects.
     */
    public static function createListFromDtoList(array $attackDtoList): array
    {
        $attackList = [];
        foreach ($attackDtoList as $attackDto) {
            $attackList[] = self::createFromDto($attackDto);
        }
        return $attackList;
    }
}
