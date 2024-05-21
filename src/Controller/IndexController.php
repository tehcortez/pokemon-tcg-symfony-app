<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PokemonCardService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @throws InvalidArgumentException
     */
    #[Route('/', name: 'pokemon_card_list')]
    public function list(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        // Validate the page parameter
        if (!is_numeric($page) || (int)$page <= 0) {
            throw new HttpException(
                Response::HTTP_BAD_REQUEST,
                'Not allowed query parameter: Page must be a positive integer'
            );
        }
        $page = (int)$page;

        try {
            $pokemonCardCollection = $this->pokemonCardService->getPokemonCardCollection($page);
        } catch (\RuntimeException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        return $this->render(
            'main/index.html.twig',
            [
                'pokemonCards' => $pokemonCardCollection->getAllCards(),
                'currentPage' => $page,
                'totalPages' => intval(ceil($pokemonCardCollection->getTotalCardsCount() / 250)),
            ]
        );
    }

    /**
     * List all Pokémon cards.
     */
    #[Route('/cards', name: 'pokemon_card_list_jquery')]
    public function listJquery(): Response
    {
        return $this->render(
            'main/cards.html.twig'
        );
    }
}
