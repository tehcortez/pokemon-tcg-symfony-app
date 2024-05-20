<?php
declare(strict_types=1);

namespace App\Dto;

use App\Dto\PokemonCardDto\AbilityDto;
use App\Dto\PokemonCardDto\AncientTraitDto;
use App\Dto\PokemonCardDto\AttackDto;
use App\Dto\PokemonCardDto\ImagesDto;
use App\Dto\PokemonCardDto\LegalitiesDto;
use App\Dto\PokemonCardDto\ResistanceDto;
use App\Dto\PokemonCardDto\SetDto;
use App\Dto\PokemonCardDto\WeaknessDto;

/**
 * Class representing a Pokémon Card Data Transfer Object.
 */
class PokemonCardDto
{
    /**
     * @var non-empty-string The ID of the Pokémon card.
     */
    private string $id;
    /**
     * @var non-empty-string The name of the Pokémon card.
     */
    private string $name;
    /**
     * @var non-empty-string The supertype of the Pokémon card.
     */
    private string $supertype;
    /**
     * @var list<non-empty-string> The subtypes of the Pokémon card.
     */
    private array $subtypes;
    /**
     * @var non-empty-string|null The level of the Pokémon card.
     */
    private ?string $level;
    /**
     * @var non-empty-string|null The hit points of the Pokémon card.
     */
    private ?string $hp;
    /**
     * @var list<non-empty-string> The types of the Pokémon card.
     */
    private array $types;
    /**
     * @var non-empty-string|null The Pokémon card that this card evolves from.
     */
    private ?string $evolvesFrom;
    /**
     * @var list<non-empty-string> The Pokémon cards that this card can evolve to.
     */
    private array $evolvesTo;
    /**
     * @var list<non-empty-string> The rules associated with the Pokémon card.
     */
    private array $rules;
    /**
     * The ancient trait of the Pokémon card.
     */
    private ?AncientTraitDto $ancientTrait;
    /**
     * @var list<AbilityDto> The abilities of the Pokémon card.
     */
    private array $abilities;
    /**
     * @var list<AttackDto> The attacks of the Pokémon card.
     */
    private array $attacks;
    /**
     * @var list<WeaknessDto> The weaknesses of the Pokémon card.
     */
    private array $weaknesses;
    /**
     * @var list<ResistanceDto> The resistances of the Pokémon card.
     */
    private array $resistances;
    /**
     * @var list<non-empty-string> The costs it takes to retreat and return the card to your bench.
     */
    private array $retreatCost;
    /**
     * @var positive-int|null The converted retreat cost of the card.
     */
    private ?int $convertedRetreatCost;
    /**
     * The set of the card.
     */
    private SetDto $set;
    /**
     * @var non-empty-string The number of the card.
     */
    private string $number;
    /**
     * @var non-empty-string The artist of the card.
     */
    private string $artist;
    /**
     * @var non-empty-string|null The rarity of the card, such as "Common" or "Rare Rainbow".
     */
    private ?string $rarity;
    /**
     * @var non-empty-string|null The flavor text of the card. This is the text that can be found on some Pokémon cards
     * that is usually italicized near the bottom of the card.
     */
    private ?string $flavorText;
    /**
     * @var list<integer> The national Pokédex numbers associated with any Pokémon featured on a given card.
     */
    private array $nationalPokedexNumbers;
    /**
     * The legalities for a given card.
     */
    private LegalitiesDto $legalities;
    /**
     * @var non-empty-string|null A letter symbol found on each card that identifies whether it is legal to use in
     * tournament play. Regulation marks were introduced on cards in the Sword & Shield Series.
     */
    private ?string $regulationMark;
    /**
     * The images for a card.
     */
    private ImagesDto $images;

    /**
     * PokemonCardDTO constructor.
     *
     * @param non-empty-string       $id
     * @param non-empty-string       $name
     * @param non-empty-string       $supertype
     * @param list<non-empty-string> $subtypes
     * @param non-empty-string|null  $level
     * @param non-empty-string|null  $hp
     * @param list<non-empty-string> $types
     * @param non-empty-string|null  $evolvesFrom
     * @param list<non-empty-string> $evolvesTo
     * @param list<non-empty-string> $rules
     * @param list<AbilityDto>       $abilities
     * @param list<AttackDto>        $attacks
     * @param list<WeaknessDto>      $weaknesses
     * @param list<ResistanceDto>    $resistances
     * @param list<non-empty-string> $retreatCost
     * @param positive-int|null      $convertedRetreatCost
     * @param non-empty-string       $number
     * @param non-empty-string       $artist
     * @param non-empty-string|null  $rarity
     * @param non-empty-string|null  $flavorText
     * @param list<integer>          $nationalPokedexNumbers
     * @param non-empty-string|null  $regulationMark
     */
    public function __construct(
        string           $id,
        string           $name,
        string           $supertype,
        array            $subtypes,
        ?string          $level,
        ?string          $hp,
        array            $types,
        ?string          $evolvesFrom,
        array            $evolvesTo,
        array            $rules,
        ?AncientTraitDto $ancientTrait,
        array            $abilities,
        array            $attacks,
        array            $weaknesses,
        array            $resistances,
        array            $retreatCost,
        ?int             $convertedRetreatCost,
        SetDto           $set,
        string           $number,
        string           $artist,
        ?string          $rarity,
        ?string          $flavorText,
        array            $nationalPokedexNumbers,
        LegalitiesDto    $legalities,
        ?string          $regulationMark,
        ImagesDto        $images
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->supertype = $supertype;
        $this->subtypes = $subtypes;
        $this->level = $level;
        $this->hp = $hp;
        $this->types = $types;
        $this->evolvesFrom = $evolvesFrom;
        $this->evolvesTo = $evolvesTo;
        $this->rules = $rules;
        $this->ancientTrait = $ancientTrait;
        $this->abilities = $abilities;
        $this->attacks = $attacks;
        $this->weaknesses = $weaknesses;
        $this->resistances = $resistances;
        $this->retreatCost = $retreatCost;
        $this->convertedRetreatCost = $convertedRetreatCost;
        $this->set = $set;
        $this->number = $number;
        $this->artist = $artist;
        $this->rarity = $rarity;
        $this->flavorText = $flavorText;
        $this->nationalPokedexNumbers = $nationalPokedexNumbers;
        $this->legalities = $legalities;
        $this->regulationMark = $regulationMark;
        $this->images = $images;
    }

    /**
     * Get the ID of the Pokémon card.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the name of the card.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the supertype of the card, such as Pokémon, Energy, or Trainer.
     */
    public function getSupertype(): string
    {
        return $this->supertype;
    }

    /**
     * Get a list of subtypes, such as Basic, EX, Mega, Rapid Strike, etc.
     *
     * @return list<non-empty-string>
     */
    public function getSubtypes(): array
    {
        return $this->subtypes;
    }

    /**
     * Get the level of the card. This only pertains to cards from older sets and those of supertype Pokémon.
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * Get the hit points of the card.
     */
    public function getHp(): ?string
    {
        return $this->hp;
    }

    /**
     * Get the energy types for a card, such as Fire, Water, Grass, etc.
     *
     * @return list<non-empty-string>
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * Get which Pokémon this card evolves from.
     * Null if Pokémon is not part of an evolutionary line.
     * Null if Pokémon is the first node in the evolutionary line.
     *
     * @return non-empty-string|null
     */
    public function getEvolvesFrom(): ?string
    {
        return $this->evolvesFrom;
    }

    /**
     * Get list of which Pokémon this card evolves to. Can be multiple, for example, Eevee.
     *
     * @return list<non-empty-string>
     */
    public function getEvolvesTo(): array
    {
        return $this->evolvesTo;
    }

    /**
     * Get a list of any rules associated with the card. For example, VMAX rules, Mega rules, or various trainer rules.
     *
     * @return list<non-empty-string>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * Get the ancient trait for a given card. Ancient Traits are special attributes given to certain Pokémon, starting
     * in the Primal Clash expansion. They are not Abilities, and as such, effects that would prevent Abilities from
     * activating (such as Wobbuffet's Bide Barricade or Garbodor's Garbotoxin) do not apply.
     * Null if card has no ancient trait.
     */
    public function getAncientTrait(): ?AncientTraitDto
    {
        return $this->ancientTrait;
    }

    /**
     * Get a list of abilities for a given card.
     *
     * @return list<AbilityDto>
     */
    public function getAbilities(): array
    {
        return $this->abilities;
    }

    /**
     * Get list attacks for a given card.
     *
     * @return list<AttackDto>
     */
    public function getAttacks(): array
    {
        return $this->attacks;
    }

    /**
     * Get a list of weaknesses for a given card.
     *
     * @return list<WeaknessDto>
     */
    public function getWeaknesses(): array
    {
        return $this->weaknesses;
    }

    /**
     * Get a list of resistances for a given card.
     *
     * @return list<ResistanceDto>
     */
    public function getResistances(): array
    {
        return $this->resistances;
    }

    /**
     * Get a list of costs it takes to retreat and return the card to your bench. Each cost is an energy type, such as
     * Water or Fire.
     *
     * @return list<non-empty-string>
     */
    public function getRetreatCost(): array
    {
        return $this->retreatCost;
    }

    /**
     * Get the converted retreat cost for a card is the count of energy types found within the retreatCost field. For
     * example, ["Fire", "Water"] has a converted retreat cost of 2.
     *
     * @return positive-int|null
     */
    public function getConvertedRetreatCost(): ?int
    {
        return $this->convertedRetreatCost;
    }

    /**
     * Get the set details embedded into the card.
     */
    public function getSet(): SetDTO
    {
        return $this->set;
    }

    /**
     * Get the number of the card.
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Get the artist of the card.
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * Get the rarity of the card, such as "Common" or "Rare Rainbow".
     *
     * @return non-empty-string|null
     */
    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    /**
     * Get the flavor text of the card. This is the text that can be found on some Pokémon cards that is usually
     * italicized near the bottom of the card.
     */
    public function getFlavorText(): ?string
    {
        return $this->flavorText;
    }

    /**
     * Get the national Pokédex numbers associated with any Pokémon featured on a given card.
     *
     * @return list<integer>
     */
    public function getNationalPokedexNumbers(): array
    {
        return $this->nationalPokedexNumbers;
    }

    /**
     * Get the legalities for a given card. A legality will not be present in the hash if it is not legal. If it is
     * legal or banned, it will be present.
     */
    public function getLegalities(): LegalitiesDto
    {
        return $this->legalities;
    }

    /**
     * Get the letter symbol found on each card that identifies whether it is legal to use in tournament play.
     * Regulation marks were introduced on cards in the Sword & Shield Series.
     */
    public function getRegulationMark(): ?string
    {
        return $this->regulationMark;
    }

    /**
     * Get the images for a card.
     */
    public function getImages(): ImagesDto
    {
        return $this->images;
    }
}
