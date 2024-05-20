<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

use App\Dto\PokemonCardDto\SetDto\ImagesDto;
use App\Dto\PokemonCardDto\SetDto\LegalitiesDto;

/**
 * Class representing a Set DTO for a Pokémon card.
 */
class SetDto
{
    /**
     * @var non-empty-string The ID of the set.
     */
    private string $id;

    /**
     * @var non-empty-string The name of the set.
     */
    private string $name;

    /**
     * @var non-empty-string The series of the set.
     */
    private string $series;

    /**
     * @var int The printed total of the set.
     */
    private int $printedTotal;

    /**
     * @var int The total of the set.
     */
    private int $total;

    /**
     * @var LegalitiesDto Legalities information of the set.
     */
    private LegalitiesDto $legalities;

    /**
     * @var non-empty-string|null The PTCGO code of the set.
     */
    private ?string $ptcgoCode;

    /**
     * @var non-empty-string The release date of the set.
     */
    private string $releaseDate;

    /**
     * @var non-empty-string The last updated date of the set.
     */
    private string $updatedAt;

    /**
     * @var ImagesDto Images information of the set.
     */
    private ImagesDto $images;

    /**
     * SetDto constructor.
     *
     * @param non-empty-string      $id
     * @param non-empty-string      $name
     * @param non-empty-string      $series
     * @param int                   $printedTotal
     * @param int                   $total
     * @param LegalitiesDto         $legalities
     * @param non-empty-string|null $ptcgoCode
     * @param non-empty-string      $releaseDate
     * @param non-empty-string      $updatedAt
     * @param ImagesDto             $images
     */
    public function __construct(
        string $id,
        string $name,
        string $series,
        int $printedTotal,
        int $total,
        LegalitiesDto $legalities,
        ?string $ptcgoCode,
        string $releaseDate,
        string $updatedAt,
        ImagesDto $images
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->series = $series;
        $this->printedTotal = $printedTotal;
        $this->total = $total;
        $this->legalities = $legalities;
        $this->ptcgoCode = $ptcgoCode;
        $this->releaseDate = $releaseDate;
        $this->updatedAt = $updatedAt;
        $this->images = $images;
    }

    /**
     * Get the ID of the set.
     *
     * @return non-empty-string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the name of the set.
     *
     * @return non-empty-string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the series of the set.
     *
     * @return non-empty-string
     */
    public function getSeries(): string
    {
        return $this->series;
    }

    /**
     * Get the PTCGO code of the set.
     *
     * @return non-empty-string|null
     */
    public function getPtcgoCode(): ?string
    {
        return $this->ptcgoCode;
    }

    /**
     * Get the release date of the set.
     *
     * @return non-empty-string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * Get the last updated date of the set.
     *
     * @return non-empty-string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * Get the images of the set.
     */
    public function getImages(): ImagesDto
    {
        return $this->images;
    }

    /**
     * Get the printed total of the set.
     */
    public function getPrintedTotal(): int
    {
        return $this->printedTotal;
    }

    /**
     * Get the total of the set.
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Get the legalities for a given set. Legalities determine in which formats the set is legal to play.
     */
    public function getLegalities(): LegalitiesDto
    {
        return $this->legalities;
    }
}
