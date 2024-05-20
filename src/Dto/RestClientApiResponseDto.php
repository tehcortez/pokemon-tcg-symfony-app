<?php

declare(strict_types=1);

namespace App\Dto;

/**
 * DTO for handling API responses.
 */
class RestClientApiResponseDto
{
    private int $statusCode;
    private string $message;
    private int $page;
    private int $pageSize;
    private int $count;
    private int $totalCount;
    /**
     * @var list<PokemonCardDto>
     */
    private array $data;

    /**
     * Constructor for RestClientApiResponseDto.
     *
     * @param int                  $statusCode The status code of the API response.
     * @param string               $message    The message of the API response.
     * @param int                  $page       The page of the API response.
     * @param int                  $pageSize   The page size of the API response.
     * @param int                  $count      The count of the API response.
     * @param int                  $totalCount The total count of the API response.
     * @param list<PokemonCardDto> $data       The response body decoded as an array, typically from a JSON payload.
     */
    public function __construct(
        int $statusCode,
        string $message,
        int $page,
        int $pageSize,
        int $count,
        int $totalCount,
        array $data
    ) {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->count = $count;
        $this->totalCount = $totalCount;
        $this->data = $data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * Retrieves the data stored in the RestClientApiResponseDto object.
     *
     * @return list<PokemonCardDto> The data stored in the RestClientApiResponseDto object.
     */
    public function getData(): array
    {
        return $this->data;
    }
}
