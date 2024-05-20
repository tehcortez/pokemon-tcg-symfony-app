<?php

declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing Legalities for a Pokémon card.
 */
class LegalitiesDto
{
    /**
     * @var non-empty-string|null The legality ruling for Standard. Can be either Legal, Banned, or not present.
     */
    private ?string $standard;

    /**
     * @var non-empty-string|null The legality ruling for Expanded. Can be either Legal, Banned, or not present.
     */
    private ?string $expanded;

    /**
     * @var non-empty-string|null The legality ruling for Unlimited. Can be either Legal, Banned, or not present.
     */
    private ?string $unlimited;

    /**
     * LegalitiesDto constructor.
     *
     * @param non-empty-string|null $standard  The legality ruling for Standard. Can be either Legal, Banned, or
     *                                         not present.
     * @param non-empty-string|null $expanded  The legality ruling for Expanded. Can be either Legal, Banned, or
     *                                         not present.
     * @param non-empty-string|null $unlimited The legality ruling for Unlimited. Can be either Legal, Banned, or
     *                                         not present.
     */
    public function __construct(?string $standard = null, ?string $expanded = null, ?string $unlimited = null)
    {
        $this->standard = $standard;
        $this->expanded = $expanded;
        $this->unlimited = $unlimited;
    }

    /**
     * Get The legality ruling for Standard. Can be either Legal, Banned, or not present.
     *
     * @return non-empty-string|null
     */
    public function getStandard(): ?string
    {
        return $this->standard;
    }

    /**
     * Get The legality ruling for Expanded. Can be either Legal, Banned, or not present.
     *
     * @return non-empty-string|null
     */
    public function getExpanded(): ?string
    {
        return $this->expanded;
    }

    /**
     * Get The legality ruling for Unlimited. Can be either Legal, Banned, or not present.
     *
     * @return non-empty-string|null
     */
    public function getUnlimited(): ?string
    {
        return $this->unlimited;
    }
}
