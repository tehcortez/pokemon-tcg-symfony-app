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
    /**
     * @var positive-int
     */
    private int $page;
    /**
     * @var positive-int
     */
    private int $pageSize;
    /**
     * @var non-negative-int
     */
    private int $count;
    /**
     * @var non-negative-int
     */
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
     * @param positive-int         $page       The page of the API response.
     * @param positive-int         $pageSize   The page size of the API response.
     * @param non-negative-int     $count      The count of the API response.
     * @param non-negative-int     $totalCount The total count of the API response.
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

    /**
     * Get the status code of the API response.
     *
     * @return int The status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the message from the RestClientApiResponseDto object.
     *
     * @return string The message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the page number from the API response.
     *
     * @return positive-int The page number.
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Get the page size of the API response.
     *
     * @return positive-int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * Get the count of card Dtos in this object
     *
     * @return non-negative-int
     */
    public function getCount(): int
    {
        return $this->count;
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
     * Retrieves the data stored in the RestClientApiResponseDto object.
     *
     * @return list<PokemonCardDto> The data stored in the RestClientApiResponseDto object.
     */
    public function getData(): array
    {
        return $this->data;
    }
}
