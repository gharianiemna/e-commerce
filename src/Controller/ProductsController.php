<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\productService;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Product;
use App\Repository\ProductRepository;

    /**
     * @Rest\Route("/api/productList", name="productList")
     */
class ProductsController extends AbstractController
{
public $entityManager;
public $productService;

public function __construct(productService $productService, EntityManagerInterface $entityManager){
    $this->productService = $productService;
    $this->entityManager = $entityManager;
}

/**
   * @Rest\Get("/")
   * @Rest\View(serializerGroups={"products"})
   */
public function displayProducts()
    {
        return $this->productService->displayProducts();
    }
/**
   * @Rest\Get("/{id}")
   * @Rest\View(serializerGroups={"products"})
   */
public function productDetail($id)
    {
        return $this->productService->displayProducts($id); 
    }



}
