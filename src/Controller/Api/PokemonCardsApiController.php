<?php

namespace App\Controller\Api;

use App\Resource\PokemonCardCollectionResource;
use App\Service\PokemonCardService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
