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
         /**
         * needded to controle what you get but time is up !
         */
        $cards = $request->get('cards');
        $colors = $request->get('color');
        $grades = $request->get('grade');
        return new JsonResponse([
             'cards' => $this->cardService->orderingCards($grades, $colors, $cards)
        ]);
    }
}
