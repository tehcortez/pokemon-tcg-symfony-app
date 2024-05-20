<?php
declare(strict_types=1);

namespace App\Model\PokemonCard;

use App\Dto\PokemonCardDto\ImagesDto;

/**
 * Class representing Images for a Pokémon card.
 */
readonly class Images
{
    /**
     * Images constructor.
     *
     * @param non-empty-string $small A smaller, lower-res image for a card. This is a URL.
     * @param non-empty-string $large A larger, higher-res image for a card. This is a URL.
     */
    private function __construct(
        public string $small,
        public string $large,
    ) {
    }

    /**
     * Create a new instance of this class from the provided ImagesDto.
     *
     * @param ImagesDto $imagesDto The data transfer object containing image information.
     */
    public static function createFromDto(ImagesDto $imagesDto): self
    {
        return new self(
            $imagesDto->getSmall(),
            $imagesDto->getLarge(),
        );
    }
}
