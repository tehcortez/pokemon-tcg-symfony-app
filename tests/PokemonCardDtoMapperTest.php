<?php

declare(strict_types=1);

namespace App\Tests;

use App\Dto\PokemonCardDto;
use App\Dto\PokemonCardDto\AbilityDto;
use App\Dto\PokemonCardDto\AncientTraitDto;
use App\Dto\PokemonCardDto\AttackDto;
use App\Dto\PokemonCardDto\ImagesDto;
use App\Dto\PokemonCardDto\LegalitiesDto as CardLegalitiesDto;
use App\Dto\PokemonCardDto\WeaknessDto;
use App\Dto\PokemonCardDto\ResistanceDto;
use App\Dto\PokemonCardDto\SetDto;
use App\Exception\BadResponseException;
use App\Mapper\PokemonCardDtoMapper;
use PHPUnit\Framework\TestCase;

class PokemonCardDtoMapperTest extends TestCase
{
    private PokemonCardTestUtility $pokemonCardUtility;

    protected function setUp(): void
    {
        $this->pokemonCardUtility = new PokemonCardTestUtility();
    }
    public function testMapCard(): void
    {
        $data = json_decode($this->pokemonCardUtility->getPokemonCardJsonData(), true)['data'];
        $cardDto = PokemonCardDtoMapper::mapCard($data);

        $this->assertInstanceOf(PokemonCardDto::class, $cardDto);
        $this->assertEquals($data['id'], $cardDto->getId());
        $this->assertEquals($data['name'], $cardDto->getName());
        $this->assertEquals($data['supertype'], $cardDto->getSupertype());
        $this->assertEquals($data['subtypes'], $cardDto->getSubtypes());
        if (isset($data['level'])) {
            $this->assertEquals($data['level'], $cardDto->getLevel());
        } else {
            $this->assertNull($cardDto->getLevel());
        }
        if (isset($data['hp'])) {
            $this->assertEquals($data['hp'], $cardDto->getHp());
        } else {
            $this->assertNull($cardDto->getHp());
        }
        $this->assertEquals($data['types'], $cardDto->getTypes());
        if (isset($data['evolvesFrom'])) {
            $this->assertEquals($data['evolvesFrom'], $cardDto->getEvolvesFrom());
        } else {
            $this->assertNull($cardDto->getEvolvesFrom());
        }
        if (isset($data['evolvesTo'])) {
            $this->assertEquals($data['evolvesTo'], $cardDto->getEvolvesTo());
        } else {
            $this->assertEmpty($cardDto->getEvolvesTo());
        }
        if (isset($data['rules'])) {
            $this->assertEquals($data['rules'], $cardDto->getRules());
        } else {
            $this->assertEmpty($cardDto->getRules());
        }
        if (isset($data['ancientTrait'])) {
            $this->assertInstanceOf(AncientTraitDto::class, $cardDto->getAncientTrait());
        } else {
            $this->assertNull($cardDto->getAncientTrait());
        }
        $this->assertCount(count($data['abilities']), $cardDto->getAbilities());
        if (count($data['abilities']) > 0) {
            $this->assertInstanceOf(AbilityDto::class, $cardDto->getAbilities()[0]);
        }
        $this->assertCount(count($data['attacks']), $cardDto->getAttacks());
        if (count($data['attacks']) > 0) {
            $this->assertInstanceOf(AttackDto::class, $cardDto->getAttacks()[0]);
        }
        $this->assertCount(count($data['weaknesses']), $cardDto->getWeaknesses());
        if (count($data['weaknesses']) > 0) {
            $this->assertInstanceOf(WeaknessDto::class, $cardDto->getWeaknesses()[0]);
        }
        $this->assertCount(count($data['resistances']), $cardDto->getResistances());
        if (count($data['resistances']) > 0) {
            $this->assertInstanceOf(ResistanceDto::class, $cardDto->getResistances()[0]);
        }
        $this->assertEquals($data['retreatCost'], $cardDto->getRetreatCost());
        $this->assertEquals($data['convertedRetreatCost'], $cardDto->getConvertedRetreatCost());
        $this->assertInstanceOf(SetDto::class, $cardDto->getSet());
        $this->assertEquals($data['number'], $cardDto->getNumber());
        $this->assertEquals($data['artist'], $cardDto->getArtist());
        $this->assertEquals($data['rarity'], $cardDto->getRarity());
        if (isset($data['flavorText'])) {
            $this->assertEquals($data['flavorText'], $cardDto->getFlavorText());
        } else {
            $this->assertNull($cardDto->getFlavorText());
        }
        $this->assertEquals($data['nationalPokedexNumbers'], $cardDto->getNationalPokedexNumbers());
        $this->assertInstanceOf(CardLegalitiesDto::class, $cardDto->getLegalities());
        if (isset($data['regulationMark'])) {
            $this->assertEquals($data['regulationMark'], $cardDto->getRegulationMark());
        } else {
            $this->assertNull($cardDto->getRegulationMark());
        }
        $this->assertInstanceOf(ImagesDto::class, $cardDto->getImages());
    }

    public function testMapCardWithBadJsonThrowsException(): void
    {
        $this->expectException(BadResponseException::class);

        $data = [
            // intentionally incomplete or bad JSON
            'id' => 'base1-4',
            'name' => 'Charizard',
            'supertype' => 'Pokémon',
            'subtypes' => ['Stage 2']
            // missing other required fields
        ];

        PokemonCardDtoMapper::mapCard($data);
    }
}
