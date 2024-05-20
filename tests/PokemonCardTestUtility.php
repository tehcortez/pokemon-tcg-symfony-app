<?php
declare(strict_types=1);

namespace App\Tests;

use App\Dto\PokemonCardDto;
use App\Model\PokemonCard;

class PokemonCardTestUtility
{
    public function getPokemonCardJsonData(): string
    {
        return <<<EOM
{
  "data": {
    "id": "pl3-143",
    "name": "Charizard G LV.X",
    "supertype": "Pokémon",
    "subtypes": [
      "Level-Up",
      "SP"
    ],
    "level": "X",
    "hp": "120",
    "types": [
      "Fire"
    ],
    "evolvesFrom": "Charizard G",
    "rules": [
      "Put this card onto your Active Charizard G. Charizard G LV.X can use any attack, Poké-Power, or Poké-Body from its previous level."
    ],
    "abilities": [
      {
        "name": "Call for Power",
        "text": "As often as you like during your turn (before your attack), you may move an Energy attached to 1 of your Pokémon to Charizard G. This power can't be used if Charizard G is affected by a Special Condition.",
        "type": "Poké-Power"
      }
    ],
    "attacks": [
      {
        "name": "Malevolent Fire",
        "cost": [
          "Fire",
          "Fire",
          "Colorless",
          "Colorless",
          "Colorless"
        ],
        "convertedEnergyCost": 5,
        "damage": "150",
        "text": "Flip a coin. If tails, discard all Energy attached to Charizard G."
      }
    ],
    "weaknesses": [
      {
        "type": "Water",
        "value": "×2"
      }
    ],
    "resistances": [
      {
        "type": "Fighting",
        "value": "-20"
      }
    ],
    "retreatCost": [
      "Colorless",
      "Colorless",
      "Colorless"
    ],
    "convertedRetreatCost": 3,
    "set": {
      "id": "pl3",
      "name": "Supreme Victors",
      "series": "Platinum",
      "printedTotal": 147,
      "total": 153,
      "legalities": {
        "unlimited": "Legal"
      },
      "ptcgoCode": "SV",
      "releaseDate": "2009/08/19",
      "updatedAt": "2018/03/07 22:40:00",
      "images": {
        "symbol": "https://images.pokemontcg.io/pl3/symbol.png",
        "logo": "https://images.pokemontcg.io/pl3/logo.png"
      }
    },
    "number": "143",
    "artist": "Wataru Kawahara",
    "rarity": "Rare Holo LV.X",
    "nationalPokedexNumbers": [6],
    "legalities": {
      "unlimited": "Legal"
    },
    "images": {
      "small": "https://images.pokemontcg.io/pl3/143.png",
      "large": "https://images.pokemontcg.io/pl3/143_hires.png"
    },
    "tcgplayer": {
      "url": "https://prices.pokemontcg.io/tcgplayer/pl3-143",
      "updatedAt": "2024/05/16",
      "prices": {
        "holofoil": {
          "low": 94.5,
          "mid": 115,
          "high": 195.98,
          "market": 149.17,
          "directLow": null
        }
      }
    },
    "cardmarket": {
      "url": "https://prices.pokemontcg.io/cardmarket/pl3-143",
      "updatedAt": "2024/05/16",
      "prices": {
        "averageSellPrice": 43.29,
        "lowPrice": 17.2,
        "trendPrice": 53.13,
        "germanProLow": 0,
        "suggestedPrice": 0,
        "reverseHoloSell": 0,
        "reverseHoloLow": 29,
        "reverseHoloTrend": 52.38,
        "lowPriceExPlus": 44.9,
        "avg1": 24.5,
        "avg7": 51.25,
        "avg30": 54.6,
        "reverseHoloAvg1": 20,
        "reverseHoloAvg7": 48.13,
        "reverseHoloAvg30": 46.58
      }
    }
  }
}
EOM;
    }

    public function getPokemonCardListJsonData(): string
    {
        return <<<EOM
{
  "data": [
    {
      "id": "pl3-143",
      "name": "Charizard G LV.X",
      "supertype": "Pokémon",
      "subtypes": [
        "Level-Up",
        "SP"
      ],
      "level": "X",
      "hp": "120",
      "types": [
        "Fire"
      ],
      "evolvesFrom": "Charizard G",
      "rules": [
        "Put this card onto your Active Charizard G. Charizard G LV.X can use any attack, Poké-Power, or Poké-Body from its previous level."
      ],
      "abilities": [
        {
          "name": "Call for Power",
          "text": "As often as you like during your turn (before your attack), you may move an Energy attached to 1 of your Pokémon to Charizard G. This power can't be used if Charizard G is affected by a Special Condition.",
          "type": "Poké-Power"
        }
      ],
      "attacks": [
        {
          "name": "Malevolent Fire",
          "cost": [
            "Fire",
            "Fire",
            "Colorless",
            "Colorless",
            "Colorless"
          ],
          "convertedEnergyCost": 5,
          "damage": "150",
          "text": "Flip a coin. If tails, discard all Energy attached to Charizard G."
        }
      ],
      "weaknesses": [
        {
          "type": "Water",
          "value": "×2"
        }
      ],
      "resistances": [
        {
          "type": "Fighting",
          "value": "-20"
        }
      ],
      "retreatCost": [
        "Colorless",
        "Colorless",
        "Colorless"
      ],
      "convertedRetreatCost": 3,
      "set": {
        "id": "pl3",
        "name": "Supreme Victors",
        "series": "Platinum",
        "printedTotal": 147,
        "total": 153,
        "legalities": {
          "unlimited": "Legal"
        },
        "ptcgoCode": "SV",
        "releaseDate": "2009/08/19",
        "updatedAt": "2018/03/07 22:40:00",
        "images": {
          "symbol": "https://images.pokemontcg.io/pl3/symbol.png",
          "logo": "https://images.pokemontcg.io/pl3/logo.png"
        }
      },
      "number": "143",
      "artist": "Wataru Kawahara",
      "rarity": "Rare Holo LV.X",
      "nationalPokedexNumbers": [6],
      "legalities": {
        "unlimited": "Legal"
      },
      "images": {
        "small": "https://images.pokemontcg.io/pl3/143.png",
        "large": "https://images.pokemontcg.io/pl3/143_hires.png"
      },
      "tcgplayer": {
        "url": "https://prices.pokemontcg.io/tcgplayer/pl3-143",
        "updatedAt": "2024/05/16",
        "prices": {
          "holofoil": {
            "low": 94.5,
            "mid": 115,
            "high": 195.98,
            "market": 149.17,
            "directLow": null
          }
        }
      },
      "cardmarket": {
        "url": "https://prices.pokemontcg.io/cardmarket/pl3-143",
        "updatedAt": "2024/05/16",
        "prices": {
          "averageSellPrice": 43.29,
          "lowPrice": 17.2,
          "trendPrice": 53.13,
          "germanProLow": 0,
          "suggestedPrice": 0,
          "reverseHoloSell": 0,
          "reverseHoloLow": 29,
          "reverseHoloTrend": 52.38,
          "lowPriceExPlus": 44.9,
          "avg1": 24.5,
          "avg7": 51.25,
          "avg30": 54.6,
          "reverseHoloAvg1": 20,
          "reverseHoloAvg7": 48.13,
          "reverseHoloAvg30": 46.58
        }
      }
    }
  ],
  "page": 1,
  "pageSize": 250,
  "count": 1,
  "totalCount": 1
}
EOM;
    }
    public function getPokemonCardDtoTest(): PokemonCardDto
    {
        return new PokemonCardDto(
            id: 'pl3-143',
            name: "Charizard G LV.X",
            supertype: "Pokémon",
            subtypes: [
                "Level-Up",
                "SP"
            ],
            level: "X",
            hp: "120",
            types: [
                "Fire"
            ],
            evolvesFrom: "Charizard G",
            evolvesTo: [],
            rules: [
                "Put this card onto your Active Charizard G. Charizard G LV.X can use any attack, Poké-Power, or Poké-Body from its previous level."
            ],
            ancientTrait: null,
            abilities: [
                new PokemonCardDto\AbilityDto(
                    name: "Call for Power",
                    text: "As often as you like during your turn (before your attack), you may move an Energy attached to 1 of your Pokémon to Charizard G. This power can't be used if Charizard G is affected by a Special Condition.",
                    type: "Poké-Power"
                )
            ],
            attacks: [
                new PokemonCardDto\AttackDto(
                    cost: [
                        "Fire",
                        "Fire",
                        "Colorless",
                        "Colorless",
                        "Colorless",
                    ],
                    name: "Malevolent Fire",
                    text: "Flip a coin. If tails, discard all Energy attached to Charizard G.",
                    damage: "150",
                    convertedEnergyCost: 5,
                )
            ],
            weaknesses: [
                new PokemonCardDto\WeaknessDto(
                    type: "Water",
                    value: "×2"
                )
            ],
            resistances: [
                new PokemonCardDto\ResistanceDto(
                    type: "Fighting",
                    value: "-20"
                )
            ],
            retreatCost: [
                "Colorless",
                "Colorless",
                "Colorless",
            ],
            convertedRetreatCost: 3,
            set: new PokemonCardDto\SetDto(
                id: "pl3",
                name: "Supreme Victors",
                series: "Platinum",
                printedTotal: 147,
                total: 153,
                legalities: new PokemonCardDto\SetDto\LegalitiesDto(
                    unlimited: "Legal"
                ),
                ptcgoCode: "SV",
                releaseDate: "2009/08/19",
                updatedAt: "2018/03/07 22:40:00",
                images: new PokemonCardDto\SetDto\ImagesDto(
                    symbol: "https://images.pokemontcg.io/pl3/symbol.png",
                    logo: "https://images.pokemontcg.io/pl3/logo.png"
                )
            ),
            number: "143",
            artist: "Wataru Kawahara",
            rarity: "Rare Holo LV.X",
            flavorText: "Charizard G LV.X can use any attack, Poké-Power, or Poké-Body from its previous level.",
            nationalPokedexNumbers: [6],
            legalities: new PokemonCardDto\LegalitiesDto(
                unlimited: "Legal"
            ),
            regulationMark: "D",
            images: new PokemonCardDto\ImagesDto(
                small: "https://images.pokemontcg.io/pl3/143.png",
                large: "https://images.pokemontcg.io/pl3/143_hires.png"
            ),
        );
    }

    public function getPokemonCardModelTest(): PokemonCard
    {
        return PokemonCard::createFromDto($this->getPokemonCardDtoTest());
    }
}
