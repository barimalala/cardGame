<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
    private $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
     /**
      * @Route("/", name="default")
      */
      public function indexAction()
      {
          return $this->render('default/index.html.twig');
      }

    /**
     * @Route("/card/{number}", name="number_card", requirements={"number"="\d+"})
     */
    public function card(int $number): object
    {
        $cards = $this->cardService->generateCards();

        return new JsonResponse([
            'cards' => $cards,
        ]);
    }

    /**
     * @Route("/card/color", name="card_color")
     */
     public function color(): object
     {
        $colors = $this->cardService->randomizeColors();
 
        return new JsonResponse([
             'colors' => $colors,
        ]);
    }

    /**
     * @Route("/card/grade", name="card_grade")
     */
     public function grade(): object
     {
        $grades = $this->cardService->randomizeGrades();
 
        return new JsonResponse([
             'grades' => $grades,
        ]);
    }

    /**
     * @Route("/card/order", name="card_ordering")
     */
     public function orderingCards(Request $request): object
     {
        $cards = \json_decode($request->get('cards'),true);
        $colors = \json_decode($request->get('color'),true);
        $grades = \json_decode($request->get('grade'),true);
 
        return new JsonResponse([
             'cards' => $this->cardService->orderingCards($grades, $colors, $cards)
        ]);
    }
}
