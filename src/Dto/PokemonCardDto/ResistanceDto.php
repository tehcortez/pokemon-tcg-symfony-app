<?php

declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing a Resistance.
 */
class ResistanceDto
{
    /**
     * @var non-empty-string The type of resistance, such as Fire or Water.
     */
    private string $type;

    /**
     * @var non-empty-string Value of the resistance
     */
    private string $value;

    /**
     * ResistanceDto constructor.
     *
     * @param non-empty-string $type  The type of resistance, such as Fire or Water.
     * @param non-empty-string $value Value of the resistance
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the type of resistance, such as Fire or Water.
     *
     * @return non-empty-string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the value of the resistance.
     *
     * @return non-empty-string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
