<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;


class UsersController extends AbstractController
{
        protected $entityManager;
        protected $userRepo;
        protected $userPasswordEncoder;
        protected $validator;
        private $security;
    public function __construct(EntityManagerInterface $entityManager,UserRepository $userRepo,
    UserPasswordEncoderInterface $userPasswordEncoder,Security $security,ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->userRepo = $userRepo;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->validator = $validator;
        $this->security = $security;
    }

    /**
     * @Rest\Get("/api/users"), name="showAllUsers"
     * @Rest\View(serializerGroups={"users"})
     */
    public function list()
    {
        return $this->userRepo->findAll();
    }

    /**
     * @Rest\Get("/api/user/{id}") , name="showUserById"
     * @Rest\View(serializerGroups={"users"})
     */
    public function getUserbyId($id){
        if (!$this->userRepo->find($id)){
            return $this->json(["error message"=> "user not found"], 404);
        }
        return $this->userRepo->find($id);
    }

    /**
   * @Rest\GET("api/userName", name="userName")
   */
    public function getUserName()
    {
        $user = $this->security->getUser();
        return $this->json($user->getName());
    }

    /**
   * @Rest\Post("api/user", name="signIn")
   */
    public function addUser(Request $request)
    {
        $user = new User();
        $data=json_decode($request->getContent());
        $user->setEmail($data->email)
            ->setName($data->name)
            //->setRoles($data->role)
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->userPasswordEncoder->encodePassword($user,$donnees->password));
        $errors = $this->validator->validate($user);
        if(count($errors) > 0){
        return $this->json([
            "error message" => (string)$errors
        ],400);
        }
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        return $this->json($user,201,[]);
    }
    /**
   * @Rest\Put("api/user/{id}", name="edit")
   */
    public function editUser(Request $request,$id)
    {
        $user = $this->userRepo->find($id);
        if(!$user){
            return $this->json(["error message" => "user not found"],404);
        }

        $data = json_decode($request->getContent());
        $user->setEmail($data->email)
                ->setName($data->name)
                ->setPassword($this->userPasswordEncoder->encodePassword($user,$data->password));
        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            return $this->json([
            "error message" => (string)$errors
        ],400);
        }
        $this->entityManager->flush();
        return $this->json($user,200);
    }

}
