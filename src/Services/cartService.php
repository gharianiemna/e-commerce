<?php

namespace App\Services;


use App\Service\MessageGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CartRepository;
use App\Entity\Cart;
use App\Repository\CartDetailsRepository;
use App\Entity\CartDetails;
use Symfony\Component\Security\Core\Security;

class cartService{

public $cartRepo;
public $cartDetailsRepo;
public $em;
public $security;
public function __construct( Security $security ,CartRepository $cartRepo , EntityManagerInterface $em, CartDetailsRepository $cartDetailsRepo){
   $this->cartRepo = $cartRepo;
   $this->em = $em;
   $this->cartDetailsRepo = $cartDetailsRepo;
   $this->security = $security;
}

public function getCart(){
    return $this->$cartRepo->findAll();
}

public function displayCartDetails(){
    $user = $this->security->getUser();
    $userId = $user->getId(); 
    $userCart=$this->cartRepo->findBy(['user'=>  $userId]);
    return $this->cartDetailsRepo->findBy(['cart'=>  $userCart]);
}

public function resetCart(){
    $user = $this->security->getUser();
    $userId = $user->getId(); 
    $userCart=$this->cartRepo->findBy(['user'=>  $userId]);
    $userCart->setTotal(null);

}


}
