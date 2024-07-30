<?php

namespace App;

use Exception;

class Arena
{
    private array $monsters;
    private Hero $hero;

    private int $size = 10;

    public function __construct(Hero $hero, array $monsters)
    {
        $this->hero = $hero;
        $this->monsters = $monsters;
    }

    public function touchable(Fighter $attacker, Fighter $defenser): bool
    {
        return $this->getDistance($attacker, $defenser) <= $attacker->getRange();
    }

    public function getDistance(Fighter $startFighter, Fighter $endFighter): float
    {
        $Xdistance = $endFighter->getX() - $startFighter->getX();
        $Ydistance = $endFighter->getY() - $startFighter->getY();
        return sqrt($Xdistance ** 2 + $Ydistance ** 2);
    }

    public function getMonstersPositions(array $monsters): array {
        $positions = [];
        foreach ($monsters as $monster) {
           $positions[] = [$monster->getX(), $monster->getY()];
        }
        return $positions;
    }

    public function move(Fighter $fighter, string $direction): void
    {
        $posPreviewX = $fighter->getX();
        $posPreviewY = $fighter->getY();
        $outOfArenaMessage = "you can't go out of arena";
        switch ($direction) {
            case 'N':
                $posPreviewY - 1;
                $posPreviewY <= 0 ? throw new Exception($outOfArenaMessage) :
                $fighter->setY($fighter->getY() - 1);
                break;
            case 'S':
                $posPreviewY + 1;
                $posPreviewY >= 9 ? throw new Exception($outOfArenaMessage) :
                $fighter->setY($fighter->getY() + 1);
                break;
            case 'W':
                $posPreviewX - 1;
                $posPreviewX <= 0 ? throw new Exception($outOfArenaMessage) :
                $fighter->setX($fighter->getX() - 1);
                break;
            case 'E':
                $posPreviewX + 1;
                $posPreviewX >= 9 ? throw new Exception($outOfArenaMessage) :
                $fighter->setX($fighter->getX() + 1);
                break;
        }
    }

    /**
     * Get the value of monsters
     */
    public function getMonsters(): array
    {
        return $this->monsters;
    }

    /**
     * Set the value of monsters
     *
     */
    public function setMonsters($monsters): void
    {
        $this->monsters = $monsters;
    }

    /**
     * Get the value of hero
     */
    public function getHero(): Hero
    {
        return $this->hero;
    }

    /**
     * Set the value of hero
     */
    public function setHero($hero): void
    {
        $this->hero = $hero;
    }

    /**
     * Get the value of size
     */
    public function getSize(): int
    {
        return $this->size;
    }
}