<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto\SetDto;

/**
 * Class representing Legalities for a card set.
 */
class LegalitiesDto
{
    /**
     * @var non-empty-string|null The standard game format. Possible values are Legal.
     */
    private ?string $standard;

    /**
     * @var non-empty-string|null The expanded game format. Possible values are Legal.
     */
    private ?string $expanded;

    /**
     * @var non-empty-string|null The unlimited game format. Possible values are Legal.
     */
    private ?string $unlimited;

    /**
     * ResistanceDto constructor.
     *
     * @param non-empty-string|null $standard  The standard game format
     * @param non-empty-string|null $expanded  The expanded game format
     * @param non-empty-string|null $unlimited The unlimited game format
     */
    public function __construct(?string $standard = null, ?string $expanded = null, ?string $unlimited = null)
    {
        $this->standard = $standard;
        $this->expanded = $expanded;
        $this->unlimited = $unlimited;
    }

    /**
     * Get the standard game format.
     *
     * @return non-empty-string|null
     */
    public function getStandard(): ?string
    {
        return $this->standard;
    }

    /**
     * Get the expanded game format.
     *
     * @return non-empty-string|null
     */
    public function getExpanded(): ?string
    {
        return $this->expanded;
    }

    /**
     * Get the unlimited game format.
     *
     * @return non-empty-string|null
     */
    public function getUnlimited(): ?string
    {
        return $this->unlimited;
    }
}
