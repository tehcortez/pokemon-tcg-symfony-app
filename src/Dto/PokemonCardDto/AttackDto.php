<?php
declare(strict_types=1);

namespace App\Dto\PokemonCardDto;

/**
 * Class representing a Pokémon card Attack. Attacks are skills that a Pokémon card can use in the Pokémon Trading Card
 * Game, which are similar to moves in the video games. Nearly every Pokémon card has at least one attack.
 */
class AttackDto
{

    /**
     * @var list<non-empty-string>
     */
    private array $cost;

    /**
     * @var non-empty-string
     */
    private string $name;

    /**
     * @var non-empty-string
     */
    private string $text;

    /**
     * @var non-empty-string
     */
    private string $damage;

    private int $convertedEnergyCost;

    /**
     * AttackDto constructor.
     *
     * @param list<non-empty-string> $cost
     * @param non-empty-string       $name
     * @param non-empty-string       $text
     * @param non-empty-string       $damage
     * @param int                    $convertedEnergyCost
     */
    public function __construct(array $cost, string $name, string $text, string $damage, int $convertedEnergyCost)
    {
        $this->cost = $cost;
        $this->name = $name;
        $this->text = $text;
        $this->damage = $damage;
        $this->convertedEnergyCost = $convertedEnergyCost;
    }

    /**
     * Get the cost of the attack represented by a list of energy types.
     *
     * @return list<non-empty-string>
     */
    public function getCost(): array
    {
        return $this->cost;
    }

    /**
     * Get the name of the attack.
     *
     * @return non-empty-string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the text or description associated with the attack.
     *
     * @return non-empty-string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get the damage amount of the attack.
     *
     * @return non-empty-string
     */
    public function getDamage(): string
    {
        return $this->damage;
    }

    /**
     * Get the total cost of the attack.
     *
     * @return int
     */
    public function getConvertedEnergyCost(): int
    {
        return $this->convertedEnergyCost;
    }
}
