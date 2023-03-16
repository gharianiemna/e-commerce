<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use App\Service\MessageGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CartRepository;
use App\Entity\Cart;


class cartService{
public $cart;
public $cartRepo;
public $request;

public function __construct(Request $request ,CartRepository $cart ,Cart $cartRepo){
   $this->$cart= $cart;
   $this->cartRepo=$cartRepo;
   $this->request=$request;
}
public function getCart(){
    return $this->$cartRepo->findAll();
}
public function saveCart($request){
    $cart = new Cart();
    $data=json_decode($request->getContent());
   
   
}
}
