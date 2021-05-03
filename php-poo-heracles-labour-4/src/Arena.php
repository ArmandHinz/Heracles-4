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

    public function getDistance(Fighter $startFighter, Fighter $endFighter): float
    {
        $Xdistance = $endFighter->getX() - $startFighter->getX();
        $Ydistance = $endFighter->getY() - $startFighter->getY();
        return sqrt($Xdistance ** 2 + $Ydistance ** 2);
    }

    public function touchable(Fighter $attacker, Fighter $defenser): bool
    {
        return $this->getDistance($attacker, $defenser) <= $attacker->getRange();
    }

    public function move(Fighter $fighter, string $direction)
    {

        $monsters = $this->getMonsters();
        $size = $this->getSize();
        $positionX = $fighter->getX();
        $positionY = $fighter->getY();
        if ($direction == "N") {
            foreach ($monsters as $monster) {
                if ($positionX  == $monster->getX() && $positionY - 1  == $monster->getY()) {
                    throw new Exception("tu es sur un enemis wtf");
                } elseif ($positionY - 1 < 0) {
                    throw new Exception("tu sort là");
                } else {
                    $fighter->setY($positionY - 1);
                }
            }
        }
        if ($direction == "S") {
            foreach ($monsters as $monster) {
                if ($positionX  == $monster->getX() && $positionY + 1 == $monster->getY()) {
                    throw new Exception("tu es sur un enemis wtf");
                } elseif ($positionY + 1 >= $size) {
                    throw new Exception("tu sort là");
                } else {
                    $fighter->setY($positionY + 1);
                }
            }
        }
        if ($direction == "E") {
            foreach ($monsters as $monster) {
                if ($positionX + 1  == $monster->getX() && $positionY == $monster->getY()) {
                    throw new Exception("tu es sur un enemis wtf");
                } elseif ($positionX + 1 >= $size) {
                    throw new Exception("tu sort là");
                } else {
                    $fighter->setX($positionX + 1);
                }
            }
        }
        if ($direction == "W") {
            foreach ($monsters as $monster) {
                if ($positionX - 1  == $monster->getX() && $positionY + 1 == $monster->getY()) {
                    throw new Exception("tu es sur un enemis wtf");
                } elseif ($positionX - 1 < 0) {
                    throw new Exception("tu sort là");
                } else {
                    $fighter->setX($positionX - 1);
                }
            }
        }
    }

    public function battle(int $id)
    {
        $monsters = $this->getMonsters();
        $hero = $this->getHero();
        if ($this->touchable($hero, $monsters[$id])) {
            if ($monsters[$id]->isAlive()) {
                $hero->fight($monsters[$id]);
            } else {
                $hero->setExperience($hero->getExperience() + $monsters[$id]->getExperience());
                unset($monsters[$id]);
                $this->setMonsters($monsters);
            }
        } else {
            throw new Exception("Out of range!");
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
