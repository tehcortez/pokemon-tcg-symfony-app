<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing an Ancient Trait for a Pokémon card.
 */
class AncientTraitDto
{
    /**
     * @var non-empty-string The name of the Ancient Trait.
     */
    private string $name;

    /**
     * @var non-empty-string The text describing the Ancient Trait.
     */
    private string $text;

    /**
     * AncientTraitDto constructor.
     *
     * @param non-empty-string $name The name of the Ancient Trait.
     * @param non-empty-string $text The text describing the Ancient Trait.
     */
    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * Get the name of the Ancient Trait.
     *
     * @return non-empty-string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the description text of the Ancient Trait.
     *
     * @return non-empty-string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
