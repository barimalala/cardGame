<?php
namespace App\tests\Service;

use App\Service\CardService;
use PHPUnit\Framework\TestCase;

class CardServiceTest extends TestCase
{

    public function testRandomizeColors()
    {
        $CardService = new CardService(10);
        $result = $CardService->randomizeColors();
        
        $this->assertEquals($CardService->getColors(), $result);
    }

    public function testRandomizeGrades()
    {
        $CardService = new CardService(10);
        $result = $CardService->randomizeGrades();
        
        $this->assertEquals($CardService->getGrades(), $result);
    }

}