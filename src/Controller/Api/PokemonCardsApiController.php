<?php

namespace App\Controller\Api;

use App\Resource\PokemonCardCollectionResource;
use App\Service\PokemonCardService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class PokemonCardsApiController extends AbstractController
{
    private PokemonCardService $pokemonCardService;

    public function __construct(PokemonCardService $pokemonCardService)
    {
        $this->pokemonCardService = $pokemonCardService;
    }

    /**
     * @throws InvalidArgumentException
     */
    #[Route('/api/pokemon-cards', name: 'api_pokemon_cards', methods: ['GET'])]
    #[OA\Get(
        path: '/api/pokemon-cards',
        summary: 'Get Pokémon cards by page',
        tags: ['Pokemon Cards'],
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: true,
                schema: new OA\Schema(
                    type: 'integer'
                ),
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Returns Pokémon cards',
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: "name",
                                            type: "string"
                                        ),
                                        new OA\Property(
                                            property: "id",
                                            type: "string"
                                        ),
                                        new OA\Property(
                                            property: "types",
                                            type: "array",
                                            items: new OA\Items(type: "string")
                                        ),
                                        new OA\Property(
                                            property: "images",
                                            properties: [
                                                new OA\Property(
                                                    property: "small",
                                                    type: "string",
                                                    format: "url"
                                                ),
                                                new OA\Property(
                                                    property: "large",
                                                    type: "string",
                                                    format: "url"
                                                )
                                            ],
                                            type: "object"
                                        ),
                                        new OA\Property(
                                            property: "resistances",
                                            type: "array",
                                            items: new OA\Items(
                                                type: "string"
                                            )
                                        ),
                                        new OA\Property(
                                            property: "weaknesses",
                                            type: "array",
                                            items: new OA\Items(
                                                type: "string"
                                            )
                                        ),
                                        new OA\Property(
                                            property: "attacks",
                                            type: "array",
                                            items: new OA\Items(
                                                type: "string"
                                            )
                                        )
                                    ],
                                    type: "object"
                                )
                            ),
                            new OA\Property(
                                property: "meta",
                                properties: [
                                    new OA\Property(property: "page", type: "integer"),
                                    new OA\Property(property: "pageSize", type: "integer"),
                                    new OA\Property(property: "totalItems", type: "integer"),
                                    new OA\Property(property: "totalPages", type: "integer")
                                ],
                                type: "object"
                            )
                        ],
                    )
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Page must be a positive integer'
            )
        ]
    )]
    public function getPokemonCardsByPage(Request $request): JsonResponse
    {
        $page = $request->query->get('page');

        // Validate the page parameter
        if (!is_numeric($page) || (int)$page <= 0) {
            return $this->json(['error' => 'Page must be a positive integer'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $page = (int)$page;
        $pokemonCardCollection = $this->pokemonCardService->getPokemonCardCollection($page);
        $pokemonCardsResource = PokemonCardCollectionResource::createFromCollection($pokemonCardCollection, $page);

        return $this->json($pokemonCardsResource->toArray());
    }
}
