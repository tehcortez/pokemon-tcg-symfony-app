<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PokemonCardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Controller for handling Pokémon card related requests.
 */
class IndexController extends AbstractController
{
    private PokemonCardService $pokemonCardService;

    public function __construct(PokemonCardService $pokemonCardService)
    {
        $this->pokemonCardService = $pokemonCardService;
    }

    /**
     * List all Pokémon cards.
     */
    #[Route('/', name: 'pokemon_card_list')]
    public function list(): Response
    {
        try {
            $pokemonCards = $this->pokemonCardService->getAllPokemonCards();
        } catch (\RuntimeException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        return $this->render(
            'main/index.html.twig',
            [
            'pokemonCards' => $pokemonCards,
            ]
        );
    }
}
