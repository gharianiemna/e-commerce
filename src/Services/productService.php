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
use App\Repository\CategoryRepository;
use App\Entity\Category;

class productService{

    protected $entityManager;
    protected $productRepository;
    protected $categoryRepository;
    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository, CategoryRepository $categoryRepository){
            $this->entityManager = $entityManager;
            $this->productRepository = $productRepository;
            $this->categoryRepository = $categoryRepository;
        }


    public function displayProducts() {
        return $this->productRepository->findAll();
    }
    public function productDetail($id) {
        return $this->productRepository->findBy(['id'=>$id]);
    }
    
    public Function displayProductByCategory($category){
        return $this->productRepository->findByCategory($category);
    }
    public function displayCategory() {
        return $this->categoryRepository->findAll();
    }
    public function CategoryDetail($id) {
        return $this->categoryRepository->findBy(['id'=>$id]);
    }  
    public function searchProduct($search) {
        return $this->productRepository->findBysearch($search);
    } 
    public function addProduct(){

    }

}

