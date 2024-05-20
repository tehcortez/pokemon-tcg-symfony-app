<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing a weakness.
 */
class WeaknessDto
{
    /**
     * @var non-empty-string The type of weakness, such as Fire or Water.
     */
    private string $type;

    /**
     * @var non-empty-string The value of the weakness.
     */
    private string $value;

    /**
     * WeaknessDto constructor.
     *
     * @param non-empty-string $type  The type of weakness.
     * @param non-empty-string $value The value of the weakness.
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the type of weakness.
     *
     * @return non-empty-string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the value of the weakness.
     *
     * @return non-empty-string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
