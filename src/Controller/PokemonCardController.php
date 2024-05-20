<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PokemonCardService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Controller for handling Pokémon card related requests.
 */
class PokemonCardController extends AbstractController
{
    private PokemonCardService $pokemonCardService;

    public function __construct(PokemonCardService $pokemonCardService)
    {
        $this->pokemonCardService = $pokemonCardService;
    }

    /**
     * Show details of a specific Pokémon card.
     *
     * @param  non-empty-string $id
     * @return Response
     */
    #[Route('/card/{id}', name: 'pokemon_card_detail')]
    public function detail(string $id): Response
    {
        try {
            $card = $this->pokemonCardService->getPokemonCardById($id);
        } catch (\RuntimeException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        } catch (InvalidArgumentException $e) {
        }

        if (!$card) {
            throw $this->createNotFoundException('The Pokémon card does not exist');
        }

        return $this->render('main/detail.html.twig', ['pokemonCard' => $card]);
    }
}
