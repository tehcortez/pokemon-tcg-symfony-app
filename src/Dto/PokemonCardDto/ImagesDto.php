<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing Images for a Pokémon card.
 */
class ImagesDto
{
    /**
     * @var non-empty-string A smaller, lower-res image for a card. This is a URL.
     */
    private string $small;

    /**
     * @var non-empty-string A larger, higher-res image for a card. This is a URL.
     */
    private string $large;

    /**
     * ImagesDto constructor.
     *
     * @param non-empty-string $small A smaller, lower-res image for a card. This is a URL.
     * @param non-empty-string $large A larger, higher-res image for a card. This is a URL.
     */
    public function __construct(string $small, string $large)
    {
        $this->small = $small;
        $this->large = $large;
    }

    /**
     * Get the smaller, lower-res image for a card.
     *
     * @return non-empty-string
     */
    public function getSmall(): string
    {
        return $this->small;
    }

    /**
     * Get the larger, higher-res image for a card.
     *
     * @return non-empty-string
     */
    public function getLarge(): string
    {
        return $this->large;
    }
}
