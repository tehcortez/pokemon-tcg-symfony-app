<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto\SetDto;

/**
 * Class representing Images for a card set.
 */
class ImagesDto
{
    /**
     * @var non-empty-string The url to the symbol image.
     */
    private string $symbol;

    /**
     * @var non-empty-string The url to the logo image.
     */
    private string $logo;

    /**
     * ImagesDto constructor.
     *
     * @param non-empty-string $symbol The url to the symbol image.
     * @param non-empty-string $logo   The url to the logo image.
     */
    public function __construct(string $symbol, string $logo)
    {
        $this->symbol = $symbol;
        $this->logo = $logo;
    }

    /**
     * Get the url to the symbol image.
     *
     * @return non-empty-string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * Get the url to the logo image.
     *
     * @return non-empty-string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }
}
