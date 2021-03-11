<?php

namespace App\Service;

class CardService
{
    private $number;
    private $grades = [];
    private $colors = [];
    private $game = [];

    public function __construct($number)
    {
        $this->number = $number;
        $this->grades = ['1','2','3','4','5','6','7','8','9','10','valet','as', 'dame', 'roi'];
        $this->colors = ['carreaux', 'trefle', 'coeur', 'pique'];

        foreach ($this->colors  as $c => $color) {
            foreach ($this->grades  as $g => $grade) {
                $this->game[]= ['color'=>$color, 'grade'=>$grade];
            }
        }

    }

    public function getGrades(): array
    {
        return $this->grades;
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function getGame(): array
    {
        return $this->game;
    }

    public function generateCards(): array
    {   \shuffle($this->game);
        return \array_slice($this->game,0,$this->number);
    }

    public function randomizeColors(): array
    {
        \shuffle($this->colors);
        return $this->colors;
    }

    public function randomizeGrades(): array
    {
        \shuffle($this->grades);
        return $this->grades;
    }

    public function orderingCards(array $grades = [] ,array $colors = [],array $games = []): array
    {

        /**
        * step 1 count grades number, count colors number
        * step 2 add graduation value for each card formula: grade position * colors number + colors position
        * step 3 ordering card by graduation value
        */
        $gradeNumber = \count($grades);
        \array_walk($games,function(&$game,$_,$params){
            $game = \json_decode($game,true);
            $game['order'] = \array_search($game['color'],$params['colors'])*$params['gradeNumber'] + \array_search($game['grade'],$params['grades']);
            return $game;
        },['grades' => $grades,'gradeNumber' => $gradeNumber,'colors' => $colors]);

        // \var_dump($games);
         usort($games, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        
        return $games;
    }
}
