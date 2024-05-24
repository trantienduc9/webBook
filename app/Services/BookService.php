<?php
namespace App\Services;
use App\Repositories\BookRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OderRepository;
use App\Repositories\CommentRespository;
use App\Repositories\UserRespository;
use App\Repositories\RoleUserRespository;
use App\Repositories\CategoryRepository;
use App\Repositories\LikeRepository;
use App\Repositories\EvaluateRepository;
use App\Repositories\ChatPrivateRepository;
use App\Repositories\PrivateMessageRepository;
class BookService
{
    protected $BookRepository;
    protected $CustomerRepository;
    protected $OderRepository;
    protected $CommentRespository;
    protected $UserRespository;
    protected $RoleUserRespository;
    protected $CategoryRepository;
    protected $LikeRepository;
    protected $EvaluateRepository;
    protected $ChatPrivateRepository;
    protected $PrivateMessageRepository;

    public function __construct(BookRepository $BookRepository, CustomerRepository $CustomerRepository, OderRepository $OderRepository, CommentRespository $CommentRespository, UserRespository $UserRespository, RoleUserRespository $RoleUserRespository, CategoryRepository $CategoryRepository, LikeRepository $LikeRepository, EvaluateRepository $EvaluateRepository, ChatPrivateRepository $ChatPrivateRepository, PrivateMessageRepository $PrivateMessageRepository)
    {
        $this->BookRepository = $BookRepository;
        $this->CustomerRepository = $CustomerRepository;
        $this->OderRepository = $OderRepository;
        $this->CommentRespository = $CommentRespository;
        $this->UserRespository = $UserRespository;
        $this->RoleUserRespository = $RoleUserRespository;
        $this->CategoryRepository = $CategoryRepository;
        $this->LikeRepository = $LikeRepository;
        $this->EvaluateRepository = $EvaluateRepository;
        $this->ChatPrivateRepository = $ChatPrivateRepository;
        $this->PrivateMessageRepository = $PrivateMessageRepository;
    }
    // Book
    public function getAllBook()
    {
        return $this->BookRepository->all();
    }

    public function getBookById($id)
    {
        return $this->BookRepository->find($id);
    }

    public function createBook($data)
    {
        return $this->BookRepository->create($data);
    }

    public function updateBook($id, $data)
    {
        return $this->BookRepository->update($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->BookRepository->delete($id);
    }

    public function getBookCategory($category){
        return $this->BookRepository->findByCategory($category);
    }

    // Customer
    public function getAllCustomer()
    {
        return $this->CustomerRepository->all();
    }

    public function createCustomer($data)
    {
        return $this->CustomerRepository->create($data);
    }
    // Oder
    public function createOder($data)
    {
        return $this->OderRepository->create($data);
    }

    public function boughtOder($idusser)
    {
        return $this->OderRepository->findByOder($idusser);
    }
    // Comment
    public function getAllComment()
    {
        return $this->CommentRespository->all();
    }

    public function createComment($data)
    {
        return $this->CommentRespository->create($data);
    }
    public function deletComment($id)
    {
        return $this->CommentRespository->delete($id);
    }
    // User
    public function getAllUser()
    {
        return $this->UserRespository->all();
    }
    public function getUserById($id)
    {
        return $this->UserRespository->find($id);
    }
    public function createUser($data)
    {
        return $this->UserRespository->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->UserRespository->update($id, $data);
    }

    public function getUserComfirm()
    {
        return $this->UserRespository->usercomfirm();
    }

    public function getAllUserWhere($id)
    {
        return $this->UserRespository->usergetwhereid($id);
    }
    // RoleUser
    public function createRoleUser($data)
    {
        return $this->RoleUserRespository->create($data);
    }


    public function updateRoleUser($id,$data)
    {
        return $this->RoleUserRespository->update($id,$data);
    }

    // Category

    public function getAllCategory()
    {
        return $this->CategoryRepository->all();
    }

    // Like

    public function createLike($data)
    {
        return $this->LikeRepository->create($data);
    }

    public function deletLikewhere($iduser,$idbook)
    {
        return $this->LikeRepository->deletewhere($iduser,$idbook);
    }

    public function getLike($iduser)
    {
        return $this->LikeRepository->findByLike($iduser);
    }

    public function getLikeCheck($iduser,$idbook)
    {
        return $this->LikeRepository->checkLike($iduser,$idbook);
    }

    // Evaluate

    public function createEvaluate($data)
    {
        return $this->EvaluateRepository->create($data);
    }

    public function getfindByEvaluate($id_book)
    {
        return $this->EvaluateRepository->findByEvaluate($id_book);
    }

    public function getEvaluateCheck($iduser,$idbook)
    {
        return $this->EvaluateRepository->checkEvaluate($iduser,$idbook);
    }

    public function updateEvaluateCheck($iduser,$idbook,$data)
    {
        return $this->EvaluateRepository->updatecheckEvaluate($iduser,$idbook,$data);
    }

    // ChatPrivate

    public function getChatPrivateById($idsend,$idsent)
    {
        return $this->ChatPrivateRepository->findByChatPrivate($idsend,$idsent);
    }
    public function createChatPrivate($data)
    {
        return $this->ChatPrivateRepository->create($data);
    }

    // chatMessagePrivate
    public function createMessagePrivate ($data)
    {
        return $this->PrivateMessageRepository->create($data);
    }
}
