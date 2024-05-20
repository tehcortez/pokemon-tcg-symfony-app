<?php

declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class AbilityDto
 * Represents an ability of a Pokémon card
 */
class AbilityDto
{
    /**
     * @var non-empty-string The name of the ability
     */
    private string $name;

    /**
     * @var non-empty-string The text value of the ability
     */
    private string $text;

    /**
     * @var non-empty-string The type of the ability, such as Ability or Pokémon-Power
     */
    private string $type;

    /**
     * AbilityDto constructor.
     *
     * @param non-empty-string $name The name of the ability
     * @param non-empty-string $text The text value of the ability
     * @param non-empty-string $type The type of the ability, such as Ability or Pokémon-Power
     */
    public function __construct(string $name, string $text, string $type)
    {
        $this->name = $name;
        $this->text = $text;
        $this->type = $type;
    }

    /**
     * Get the name of the ability.
     *
     * @return non-empty-string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the text value of the ability.
     *
     * @return non-empty-string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get the type of the ability, such as Ability or Pokémon-Power
     *
     * @return non-empty-string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
