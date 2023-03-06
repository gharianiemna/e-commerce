<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use App\Service\MessageGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ProductRepository;
use App\Entity\Product;

class productService{

    protected $entityManager;
    protected $productRepository;
    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository){
            $this->entityManager = $entityManager;
            $this->productRepository = $productRepository;
        }


    public function displayProducts() {
        return $this->productRepository->findAll();
    }
    public function productDetail($id) {
        return $this->productRepository->findBy(['id'=>$id]);
    }
    
    public function addProduct(){

    }

}

