<?php

class RankingTable
{
    protected array $results;

    public function __construct(array $players) {
       foreach($players as $key => $player) {
         $this->results[] = [$player, 0, 0, $key + 1];
       }
    }

    public function recordResult(string $player, int $points): void {
        foreach($this->results as $key => $value) {
            if ($this->results[$key][0] === $player) {
                $this->results[$key][1]++;
                $this->results[$key][2] += $points;
            }
        }
    }

    public function playerRank(int $position): string {
        if ($position <= 0 || $position > count($this->results)) {
            return "Please type rank number <1, " . count($this->results) . ">!";
        }

        usort($this->results, function($a, $b) {
            $result = $b[2] <=> $a[2];

            if ($result === 0) {
               $result = $a[1] <=> $b[1];

               if ($result === 0) {
                   return $a[3] <=> $b[3];
               } else {
                   return $result;
               }
            } else {
               return $result;
            }
        });

        //print_r($this->results);

        return $this->results[$position - 1][0];
    }
}

$table = new RankingTable(array('Jan', 'Maks', 'Monika'));
$table->recordResult('Jan', 2);
$table->recordResult('Maks', 3);
$table->recordResult('Monika', 5);
print $table->playerRank(1) . "\n";
