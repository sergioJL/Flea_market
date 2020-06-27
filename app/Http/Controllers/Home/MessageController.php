<?php

namespace App\Http\Controllers\Home;

use App\model\Message;
use App\model\Product;
use App\model\User;
use Exception;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BaseRepository
     */
    private $productRepository;

    /**
     * @var BaseRepository
     */
    private $userRepository;

    /**
     * @var BaseRepository
     */
    private $mesRepository;

    /**
     * MessageController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $this->entityManager->getRepository(Product::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->mesRepository = $this->entityManager->getRepository(Message::class);
    }

    /**
     * @param Request $request
     * @return int
     * @throws Exception
     */
    public function addMes(Request $request)
    {
        /*if ($request->get('productid'))
        {
            return $request->all();
        }*/
//        echo ($request->all());
        if ($request->get('mes_id') == -1) {
            $message = new Message($request->get('mes'), session('user_id'));
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $cql = sprintf('match (n),(p) where id(n)=%d and id(p)=%d create (p)-[:mes]->(n)', $message->getId(), $request->get('productid'));
            $this->entityManager->createQuery($cql)
                ->execute();
        }
        else {
            $message = new Message($request->get('mes'), session('user_id'), $request->get('receiver_id'));
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $cql = sprintf('match (n),(p) where id(n)=%d and id(p)=%d create (p)-[:mes]->(n)', $message->getId(), $request->get('mes_id'));
            $this->entityManager->createQuery($cql)
                ->execute();
        }
        return 1;
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     * @throws Exception
     */
    public function delMes(Request $request,$id)
    {
        $cql = sprintf("match p=(n)-[*]->(:Message) where id(n)=%d detach delete n,p;",(int)$id);
        $this->entityManager->createQuery($cql)
            ->execute();
        $cql2 = sprintf("match (n) where id(n)=%d detach delete n;",(int)$id);
        $this->entityManager->createQuery($cql2)
            ->execute();
        return 1;
    }

    public function addMesTest(Request $request)
    {
        $message = new Message('123', 12);
        $this->entityManager->persist($message);
        $this->entityManager->flush();
        echo 'OK';
    }
}
