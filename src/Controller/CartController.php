<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CartDetails;
use App\Entity\Cart;
use App\Repository\CartDetailsRepository;
use App\Repository\CartRepository;
use App\Services\cartService;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/api/Cart", name="Cart")
 */
class CartController extends AbstractController
{
    public $entityManager;
    public $cartService;

    public function __construct(CartService $cartService, EntityManagerInterface $entityManager){
        $this->cartService = $cartService;
        $this->entityManager = $entityManager;
    }

    /**
   * @Rest\Get("/")
   * @Rest\View(serializerGroups={"cartDetails"})
   */
    public function displayCartDetails()
    {
        return $this->cartService->displayCartDetails();
    }

    /**
   * @Rest\Post("/")
   */

    public function saveCart(Request $request, SerializerInterface $serializer){
        try {
            $newCart = $serializer->deserialize($request->getContent(),Cart::class,'json');
            $this->em->persist($newCart);
            $this->em->flush();
            return $newCart;
        } catch (NotEncodableValueException $e) {
            return $this->json(["error message"=>$e->getMessage()],400);
        }
    }
   

}
