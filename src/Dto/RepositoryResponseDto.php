<?php

declare(strict_types=1);

namespace App\Dto;

/**
 * DTO for handling API responses.
 */
class RepositoryResponseDto
{
    /**
     * @var non-negative-int
     */
    private int $totalCount;
    /**
     * @var list<PokemonCardDto>
     */
    private array $pokemonCardDtoList;

    /**
     * Constructor for RestClientApiResponseDto.
     *
     * @param non-negative-int $totalCount The total count of cards from the API response.
     * @param list<PokemonCardDto> $pokemonCardDtoList The response body decoded as a list.
     */
    public function __construct(
        int $totalCount,
        array $pokemonCardDtoList
    ) {
        $this->totalCount = $totalCount;
        $this->pokemonCardDtoList = $pokemonCardDtoList;
    }

    /**
     * Get the total count of cards from the API
     *
     * @return non-negative-int The total count of cards from the API
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * Get the list of PokemonCardDto objects.
     *
     * @return list<PokemonCardDto> The list of PokemonCardDto objects.
     */
    public function getPokemonCardDtoList(): array
    {
        return $this->pokemonCardDtoList;
    }

    /**
     * Creates a new instance of this class from a RestClientApiResponseDto object.
     */
    public static function createFromDto(RestClientApiResponseDto $responseDto): self
    {
        $totalCount = $responseDto->getTotalCount();
        return new self(
            totalCount: $totalCount,
            pokemonCardDtoList: $responseDto->getData()
        );
    }
}
