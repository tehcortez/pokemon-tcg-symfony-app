<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\PokemonCardDto;
use App\Dto\PokemonCardDto\AbilityDto;
use App\Dto\PokemonCardDto\AncientTraitDto;
use App\Dto\PokemonCardDto\AttackDto;
use App\Dto\PokemonCardDto\ImagesDto;
use App\Dto\PokemonCardDto\LegalitiesDto as CardLegalitiesDto;
use App\Dto\PokemonCardDto\SetDto\LegalitiesDto as SetLegalitiesDto;
use App\Dto\PokemonCardDto\WeaknessDto;
use App\Dto\PokemonCardDto\ResistanceDto;
use App\Dto\PokemonCardDto\SetDto;
use App\Dto\PokemonCardDto\SetDto\ImagesDto as SetImagesDto;
use App\Exception\BadResponseException;

class PokemonCardDtoMapper
{
    /**
     * @param  list<array<mixed>> $data
     * @return list<PokemonCardDto>
     */
    public static function mapCardList(array $data): array
    {
        return array_map(
            fn($card) => self::mapCard($card),
            $data
        );
    }

    /**
     * @param  array<mixed> $data
     * @return PokemonCardDto
     */
    public static function mapCard(array $data): PokemonCardDto
    {
        if (
            !isset($data['set'])
            || !is_array($data['set'])
            || !isset($data['set']['legalities'])
            || !is_array($data['set']['legalities'])
        ) {
            throw new BadResponseException('Bad JSON');
        }
        $setLegalities = new SetLegalitiesDto(
            $data['set']['legalities']['standard'] ?? null,
            $data['set']['legalities']['expanded'] ?? null,
            $data['set']['legalities']['unlimited'] ?? null,
        );
        $setImages = new SetImagesDto(
            $data['set']['images']['symbol'],
            $data['set']['images']['logo'],
        );
        $set = new SetDto(
            $data['set']['id'],
            $data['set']['name'],
            $data['set']['series'],
            $data['set']['printedTotal'],
            $data['set']['total'],
            $setLegalities,
            $data['set']['ptcgoCode'] ?? null,
            $data['set']['releaseDate'],
            $data['set']['updatedAt'],
            $setImages
        );

        $abilities = array_map(
            fn($ability) => new AbilityDto(
                $ability['name'],
                $ability['text'],
                $ability['type']
            ),
            $data['abilities'] ?? []
        );

        $attacks = array_map(
            fn($attack) => new AttackDTO(
                $attack['cost'],
                $attack['name'],
                $attack['text'],
                $attack['damage'],
                $attack['convertedEnergyCost']
            ),
            $data['attacks'] ?? []
        );

        $weaknesses = array_map(
            fn($weakness) => new WeaknessDTO(
                $weakness['type'],
                $weakness['value']
            ),
            $data['weaknesses'] ?? []
        );

        $resistances = array_map(
            fn($resistance) => new ResistanceDTO(
                $resistance['type'],
                $resistance['value']
            ),
            $data['resistances'] ?? []
        );

        $ancientTrait = null;
        if (isset($data['ancientTrait'])) {
            $ancientTrait = new AncientTraitDto(
                $data['ancientTrait']['name'],
                $data['ancientTrait']['text']
            );
        }

        $legalities = new CardLegalitiesDto(
            $data['legalities']['standard'] ?? null,
            $data['legalities']['expanded'] ?? null,
            $data['legalities']['unlimited'] ?? null,
        );

        $images = new ImagesDto(
            $data['images']['small'],
            $data['images']['large'],
        );

        return new PokemonCardDTO(
            id: $data['id'],
            name: $data['name'],
            supertype: $data['supertype'],
            subtypes: $data['subtypes'],
            level: $data['level'] ?? null,
            hp: $data['hp'] ?? null,
            types: $data['types'],
            evolvesFrom: $data['evolvesFrom'] ?? null,
            evolvesTo: $data['evolvesTo'] ?? [],
            rules: $data['rules'] ?? [],
            ancientTrait: $ancientTrait,
            abilities: $abilities,
            attacks: $attacks,
            weaknesses: $weaknesses,
            resistances: $resistances,
            retreatCost: $data['retreatCost'] ?? [],
            convertedRetreatCost: $data['convertedRetreatCost'] ?? null,
            set: $set,
            number: $data['number'],
            artist: $data['artist'],
            rarity: $data['rarity'] ?? null,
            flavorText: $data['flavorText'] ?? null,
            nationalPokedexNumbers: $data['nationalPokedexNumbers'],
            legalities: $legalities,
            regulationMark: $data['regulationMark'] ?? null,
            images: $images
        );
    }
}
