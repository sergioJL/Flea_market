<?php

namespace App\Http\Controllers\User;

use App\model\Announcement;
use App\model\Message;
use Exception;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\User;
use App\model\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BaseRepository
     */
    private $userRepository;

    /**
     * @var BaseRepository
     */
    private $productRepository;

    /**
     * @var BaseRepository
     */
    private $annoRepository;

    /**
     * UserController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->productRepository = $this->entityManager->getRepository(Product::class);
        $this->annoRepository = $this->entityManager->getRepository(Announcement::class);
    }

    /**
     * 获取用户详情信息
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getUserMsg(Request $request)
    {
        $id = session('user_id');
        $user =$this->userRepository->findOneById($id);
        $userMsg = $user->getUser();
        $mes_cql = sprintf('match (k:Message)<-[*]-(m:Product) where k.senderid = %d return k ;', $id);
        $mes_result = $this->entityManager->createQuery($mes_cql)
            ->addEntityMapping('n', User::class)
            ->addEntityMapping('m',Product::class)
            ->addEntityMapping('k',Message::class)
            ->execute();
        $product_cql = sprintf("match (m:User)-[:出售]->(n:Product) where id(m)=%d and n.status=0 return n ;",$id);
        $products_relute = $this->entityManager->createQuery($product_cql)
            ->addEntityMapping('n', Product::class)
            ->execute();

        $product_cql2 = sprintf("match (m:User)-[:like]->(n:Product) where id(m)=%d and n.status=0 return n ;",$id);
        $products_relute2 = $this->entityManager->createQuery($product_cql2)
            ->addEntityMapping('n', Product::class)
            ->execute();
        //var_dump($userMsg);

        return view('User.member')->with(['user'=>$userMsg,'mes_num'=>count($mes_result), 'product_num'=>count($products_relute), 'product_likenum'=>count($products_relute2)]);//*/
    }

    /**
     * 按钮点击事件 将物品链接到我想要的
     *
     * @param Request $request
     * @param $id
     * @return int
     * @throws Exception
     */
    public function getIwant(Request $request, $id)
    {
        $user_id = session('user_id');
        $user = $this->userRepository->findOneById($user_id);
        //$student_id = $request->get('student_id');
        //$user = $this->userRepository->findOneBy(['student_id'=>$student_id]);
        $product = $this->productRepository->findOneById((int)$id);

        //$student_id, $name, $nickname, $psd, $college, $profession, $start_year, $phone_num
        $user->addIwantNode($product);
        //$this->entityManager->persist($product);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        //echo '<script>alert("OK");</script>';
        //return back();
        //return back()->with('success','操作成功');
        return 1;
        //return redirect(url()->previous());
    }

    /**
     * 获取我发布的
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getMyproduct(Request $request)
    {
        $id = session('user_id');
        //$student_id = '1248';
        //$cql = sprintf("match (m:User{student_id:'%s'})-[:出售]->(n) return n",$student_id);
        $cql = sprintf("match (m:User)-[:出售]->(n:Product) where id(m)=%d and n.status=0 return n ;",$id);
        $myproducts = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $products = array();
        //array_push($a,"blue","yellow")
        foreach ($myproducts as $product)
        {
            $products[] = $product->get_product();
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($products);
        // Define how many items we want to be visible in each page
        $perPage = 10;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('User.userCollect')->with(['products'=>$paginatedItems,'num'=>count($products)]);
    }

    /**
     * 获取标记我想要的
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getIwanted(Request $request)
    {
        //$student_id = '201611101056';
        //$cql = sprintf("match (:User{student_id:'%s'})-[:like]->(n) where n.status=0 return distinct n",$student_id);
        $id = session('user_id');
        $cql = sprintf("match (m:User)-[:like]->(n) where id(m)= %d and n.status=0 return distinct n",$id);
        $myproducts = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $products = array();
        //array_push($a,"blue","yellow")
        foreach ($myproducts as $product)
        {
            $products[] = $product->get_product();
        }
        return view('User.userLike')->with('products',$products);
    }

    /**
     * 移除我想要的
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getIwanted_del(Request $request)
    {
        $id = session('user_id');
        $cql = sprintf("match (m:User)-[:like]->(n) where id(m)= %d and n.status=1 return distinct n",$id);
        $myproducts = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $products = array();
        //array_push($a,"blue","yellow")
        foreach ($myproducts as $product)
        {
            $products[] = $product->get_product();
        }
        return view('User.userLike')->with('products',$products);
    }

    /**
     * 获取我在寻找的
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function Ifind(Request $request)
    {
        $id = session('user_id');
        $cql = sprintf("match (m:User)-[:find]->(n:Product) where id(m)= %d and n.status=0 return distinct n",$id);
        $myproducts = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $products = array();
        //array_push($a,"blue","yellow")
        foreach ($myproducts as $product)
        {
            $products[] = $product->get_product();
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($products);
        // Define how many items we want to be visible in each page
        $perPage = 10;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        if ($request->has('create'))
        {
            return view('User.userFind')->with(['products'=>$paginatedItems,'create'=>1]);
        }
        return view('User.userFind')->with('products',$paginatedItems);
    }

    /**
     * @param Request $request
     * @throws Exception
     */
    public function leave_message(Request $request)
    {
        //留言
        $student_id = '201611101056';
        $user =$this->userRepository->findOneBy(['student_id'=>$student_id]);
        $user_id = $user->getId();
        $title = 'iphone8';
        $product = $this->productRepository->findOneBy(['title' => $title]);
        $product_id = $product->getId();
        $mes = '好';
        //dd(gettype($user), gettype($product));
        $cql = sprintf("match (n:User),(m:Product)
                                where id(n)=%d and id(m)=%d
                                create (k:Message{content:'%s',read:0}),
                                (n)-[:mes]->(k)<-[:mes]-(m) ;", $user_id, $product_id, $mes);
        $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', User::class)
            ->addEntityMapping('m',Product::class)
            ->addEntityMapping('k',Message::class)
            ->execute();

        echo 'OK';
    }

    /**
     * test
     * @param Request $request
     */
    public function leave_messageByORM(Request $request)
    {
        //留言
        $student_id = '201611101056';
        $user =$this->userRepository->findOneBy(['student_id'=>$student_id]);
        $title = 'iphone8';
        $product = $this->productRepository->findOneBy(['title' => $title]);
        $mes = '好';
        $user->addMessage($product, $mes);
    }

    /**
     * @param Request $request
     * @throws Exception
     */
    public function relpyMessage(Request $request)
    {
        $mes_id = 154;
        $mes = '123';
        $cql = sprintf("match (n:Message)
                        where id(n)=%d
                        set n.read=1
                        create (m:Message{content:'%s', read:0}),
                        (n)-[:mes]->(m)", $mes_id, $mes);
        $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Message::class)
            ->addEntityMapping('m',Message::class)
            ->execute();
        echo 'OK';
    }

    public function myallmessage(Request $request)
    {
        $id= session('user_id');
        $cql = sprintf('match (k:Message)<-[*]-(m:Product) where k.senderid = %d return m,k ;', $id);
        $result = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', User::class)
            ->addEntityMapping('m',Product::class)
            ->addEntityMapping('k',Message::class)
            ->execute();
        $messages = array();
        foreach($result as $r)
        {
            $message=array(
                'Product'=>$r['m']->get_product(),
                'mes'=>$r['k']->getMessage()
            );
            $messages[]=$message;
        }
        //dd($messages);
        return view('User.userLeaveMessage')->with('messages',$messages);
    }

    /**
     * @param Request $request
     * @return int
     * @throws Exception
     */
    public function getUnreadMessage(Request $request)
    {
        $id = session('user_id');
        $cql1 = sprintf('match (n:User)-[:`出售`]->(:Product)-[:mes]->(m:Message) where id(n)=%d and m.read=0 return m ;', $id);
//        $cql2 = sprintf('match (n:Product)-[*]->(m:Message)<-[*]-(u:User) where id(u)=%d with m match (m)-[*]->(k:Message) where k.creator=1 and k.read=0 return k;', $id);
        $cql2 = sprintf('match (k:Message) where k.receiverid = %d and k.read=0 return k', $id);
        $result1 = $this->entityManager->createQuery($cql1)->execute();
        $result2 = $this->entityManager->createQuery($cql2)->execute();
        return count($result1)+count($result2);
        //dd($result1, $result2);

    }

    /**
     * 标记已读
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function setMessageReaded(Request $request)
    {
        $cql = sprintf('match (k:Message) where id(k)=%d set k.read = 1 ',$request->get('mes_id'));
        $result1 = $this->entityManager->createQuery($cql)->execute();
        return redirect('/product/detail/'.$request->get('product_id'));
    }

    /**
     * 他人回复的消息
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getMessageOnProductDetail(Request $request)
    {
        $id= session('user_id');
        $cql = sprintf('match (k:Message)<-[*]-(m:Product) where k.senderid = %d return m,k ;', $id);

        $cql1 = sprintf('match (n:User)-[:`出售`]->(m:Product)-[:mes]->(k:Message) where id(n)=%d and k.read=0 return m,k ;', $id);
//        $cql2 = sprintf('match (n:Product)-[*]->(m:Message)<-[*]-(u:User) where id(u)=%d with m match (m)-[*]->(k:Message) where k.creator=1 and k.read=0 return k;', $id);
        $cql2 = sprintf('match (m:Product)-[*]->(k:Message) where k.receiverid = %d and k.read = 0  return m,k', $id);

        $result1 = $this->entityManager->createQuery($cql1)
            ->addEntityMapping('m',Product::class)
            ->addEntityMapping('k',Message::class)
            ->execute();
        $result2 = $this->entityManager->createQuery($cql2)
            ->addEntityMapping('m',Product::class)
            ->addEntityMapping('k',Message::class)
            ->execute();

        $result = array_merge($result1, $result2);
        if(count($result)>0)
        {
            $messages = array();
            foreach($result as $r)
            {
                $message=array(
                    'Product'=>$r['m']->get_product(),
                    'mes'=>$r['k']->getMessage(),
                    'mes_id'=>$r['k']->getId()
                );
                $messages[]=$message;
            }
            //dd($messages);
            return view('User.userLeaveMessageReply')->with('messages',$messages);
        }
        else
        {
            return view('User.userLeaveMessageReply')->with('messages',array());
        }

    }

    /**
     * 移除用户
     *
     * @param Request $request
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteUser(Request $request, $id)
    {
        $cqls = array(
            "match p = (n:User)-[:出售]->(b)-[*]->(:Message) where id(n)=%d detach delete p;",
            "match p = (n:User)-[:出售]->(b) where id(n)=%d detach delete p;",
            "match (n:User) where id(n)=%d detach delete n;",
            "match p = (n:Message)-[*]->(:Message) where n.senderid=%d detach delete p;",
            "match p = (n:Message) where n.senderid=%d detach delete p;"
        );
        foreach ($cqls as $cql)
        {
            $c = sprintf($cql,(int)$id);
            $this->entityManager->createQuery($c)
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
    public function deleteMessage( Request $request, $id)
    {
        $cql = sprintf('match p=(n)-[*]->(m:Message) where id(n)=%d detach delete p', $id);
        $this->entityManager->createQuery($cql)
            ->execute();
        $cql2 = sprintf('match (n:Message) where id(n)=%d  detach delete n,m', $id);
        $this->entityManager->createQuery($cql2)
            ->execute();
        return 1;
    }

    public function getNotice(Request $request)
    {
        $annos = $this->annoRepository->findAll();
        $notices = array();
        foreach ($annos as $anno)
        {
            $notices[]=$anno->getAnno();
        }
        // dd($notices);
        return view('User.Notice')->with('notices',$notices);
    }

    /**
     * @param Request $request
     * @return int
     * @throws Exception
     */
    public function changePrice(Request $request)
    {
        $this->validate($request,[
            //具体的规则
            //字段 => 验证规则1|验证规则2|...
            'id'=>'required',
            'price'=>'required'
        ]);
        $product = $this->productRepository->findOneById((int)$request->get('id'));
        $product->setPrice($request->get('price'));
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return 1;
    }
}
