<?php

namespace App\Http\Controllers\Home;

use App\model\Announcement;
use App\model\Message;
use App\model\ReplyMessage;
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
use App\model\UPLink;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Array_;

class ProductsController extends Controller
{
    //
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
     * ProductsController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $this->entityManager->getRepository(Product::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * @throws /Exception
     */
    public function test()
    {
        $user = new User('201611101055', 'lisi', 'serg', '123', 'wdwq', 'ssss', '22222', 'asdadsad');
        $product = new Product('华为手机', array("电脑数码", "手机"), 1200, 'sadasdasdsad',
            array('123', '123'));
        $this->entityManager->persist($product);
        //$student_id, $name, $nickname, $psd, $college, $profession, $start_year, $phone_num
        $user->addNode($product);
        //$this->entityManager->persist($product);
        $this->entityManager->persist($user);

        // $this->entityManager->persist($link);
        $this->entityManager->flush();
        echo 'OK';
    }

    /**
     * 发布商品
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function AddProduct(Request $request)
    {
        if ($request->method() == 'POST') {
            //dd($request->all());
            //var_dump($request->get('title'));;
            $this -> validate($request,[
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'title' => 'required',
                'plabel'=>'required',
                'price'=>'required',
                'avatar'=>'required',
                'detailed_description'=>'required'
            ]);
            $image = array();
            if ($request->hasFile('avatar')) {
                foreach ($request->file('avatar') as $file) {
                    /*$path = md5($request->get('name'));
                    $filename = md5(time() .
                            rand(100000, 999999)) . '.' . $file->getClientOriginalExtension();
                    $file->move('./storage/'. $path, $filename);
                    $image[] = $path.'/'.$filename;*/
                    $path = '';
                    $filename = md5(time() .
                            rand(100000, 999999)) . '.' . $file->getClientOriginalExtension();
                    $file->move('./storage/' . $path, $filename);
                    $image[] = $path . '/' . $filename;
                }

            }
            $product = new Product(
                $request->get('title'),
                $request->get('plabel'),
                (int)$request->get('price'),
                $request->get('detailed_description'),
                $image
            );
            //id 从session中取得
            //$user = $this->userRepository->findOneById(0);
            $user = $this->userRepository->findOneById(session('user_id'));
            $user->addNode($product);
            $this->entityManager->persist($product);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            //dd($poduct);
            echo "<script>alert('添加成功')</script>";
            return redirect('/user/myproducts')->with('create', 1);
        } else {
            return view('User.addproduct');
        }
    }

    /**
     * 发布求购商品
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function AddFindProduct(Request $request)
    {
        if ($request->method()=='POST') {
//        if ($request->get('title') != null) {
            //dd($request->all());
            $this -> validate($request,[
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'title' => 'required',
                'plabel'=>'required',
                'price'=>'required',
                'detailed_description'=>'required'
            ]);
            $image = array();
            if ($request->hasFile('avatar')) {
                foreach ($request->file('avatar') as $file) {
                    $path = '';
                    $filename = md5(time() .
                            rand(100000, 999999)) . '.' . $file->getClientOriginalExtension();
                    $file->move('./storage/' . $path, $filename);
                    $image[] = $path . '/' . $filename;
                }

            }
            else
            {
                $image[] = '99920a787050a10e9db6e5fe9d8bba49.jpg';
            }
            $product = new Product(
                $request->get('title'),
                $request->get('plabel'),
                (int)$request->get('price'),
                $request->get('detailed_description'),
                $image
            );
            $this->entityManager->persist($product);
            $this->entityManager->flush();
            $product_id = $product->getId();
            //dd($prduct_id);
            $id = (int)session('user_id');
            $cql = sprintf("match (n:User),(m:Product) where id(n)=%d and id(m)=%d create (n)-[:find]->(m);", $id, $product_id);
            $this->entityManager->createQuery($cql)
                ->execute();
            return redirect('/user/Ifinded');
            //echo "<script>alert('添加成功')</script>";
        } else {
            return view('User.addproduct');
        }
    }

    /**
     * 首页
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function showall(Request $request)
    {
        //dd(session('user_id'),session('nickName'),session()->get('user_id'),session());
        $cql_all = 'match (n)-[:出售]->(m:Product) return m ORDER BY m.time DESC limit 4;';
        $all_product = $this->entityManager->createQuery($cql_all)
            ->addEntityMapping('m', Product::class)
            ->execute();
        //$all_product = $this->productRepository->findAll();
        $all = array();
        //array_push($a,"blue","yellow")
        foreach ($all_product as $product) {
            $all[] = $product->get_product();
        }
        //return view('Product.showall')->with('all', $all);
        $ilikes = 0;
        if (session()->has('user_id')) {
            $cql = sprintf('match (k:User)-[:like]->(m:Product) where id(k)=%d return distinct m', session('user_id'));
            $ilikesnum = $this->entityManager->createQuery($cql)
                ->addEntityMapping('k', User::class)
                ->execute();
            $ilikes = count($ilikesnum);
        } else {
            $ilikes = 0;
        }
        $product_f = $this->show_f();
        $anno = $this->get_announcement();
        return view('Product.index2')->with(['all' => $all, 'ilikes' => $ilikes, 'F'=>$product_f, 'anno'=>$anno]);
        //dd($all_product);
    }

    /**
     * @throws Exception
     */
    public function show_f()
    {
        $cql_1F=array("match (n:Product) where ANY (ax in n.label where ax ='电脑数码') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='运动户外') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='服饰鞋包') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='个护化妆') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='日用百货') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='配饰腕表') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='图书影像') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='玩模乐器') return n limit 6;",
            "match (n:Product) where ANY (ax in n.label where ax ='办公设备') return n limit 6;");
        $result = array();
        foreach ($cql_1F as $cql)
        {
            $F = $this->entityManager->createQuery($cql)
                ->addEntityMapping('n', Product::class)
                ->execute();
            $products = array();
            foreach ($F as $f)
            {
                $products[]=$f->get_product();
            }
            $result[]=$products;
        }
        return $result;
    }

    public function get_announcement()
    {
        $cql = "match (n:Anno) return n limit 10;";
        $result = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Announcement::class)
            ->execute();
        $Ann = array();
        foreach ($result as $r)
        {
            $Ann[]=$r->getAnno();
        }
        return $Ann;
    }

    /**
     * 商品详情
     *
     * @param Request $request
     * @param $id
     * @return Factory|Application|View
     * @throws Exception
     */
    public function showDetail(Request $request, $id)
    {
        //$id = $request->get('id');
        $product = $this->productRepository->findOneById($id);
        //$title = 'iphone8';
        //$product = $this->productRepository->findOneBy(['title' => $title]);
        //$product_id = $product->getId();
        //$product_id = $request->get('product_id');
        //$product = $this->productRepository->findOneById($product_id);
        $productDetail = $product->get_product();
        // 获取手机号
        $cql_a = sprintf('match (k:User)-[:出售]->(m:Product) where id(m)=%d return k', (int)$id);
        $user = $this->entityManager->createQuery($cql_a)
            ->addEntityMapping('k', User::class)
            ->addEntityMapping('m', Product::class)
            ->execute();
        if (count($user)==0)
        {
            $cql_a = sprintf('match (k:User)-[:find]->(m:Product) where id(m)=%d return k', (int)$id);
            $user = $this->entityManager->createQuery($cql_a)
                ->addEntityMapping('k', User::class)
                ->addEntityMapping('m', Product::class)
                ->execute();
        }
//        dd($user);
        $phone_num = $user[0]->get_phonenum();
        //获取该用户其他物品
        $cql_b = sprintf('match (k:User)-[:出售]->(m:Product) where id(k)=%d return m', $user[0]->getId());
        $ResultuserProducts = $this->entityManager->createQuery($cql_b)
            ->addEntityMapping('k', User::class)
            ->addEntityMapping('m', Product::class)
            ->execute();
        $userProducts = array();
        foreach ($ResultuserProducts as $rup) {
            $userProducts[] = $rup->get_product();
        }

        /*
        $cql = sprintf('match (k:User)-[:mes]->(n:Message)<-[:mes]-(m:Product) where id(m)=%d return k,n', $id);
        $mess = $this->entityManager->createQuery($cql)
            ->addEntityMapping('k', User::class)
            ->addEntityMapping('n', Message::class)
            ->execute();
        */
        $mess = $this->product_message($id);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($mess);
        // Define how many items we want to be visible in each page
        $perPage = 5;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        if (session()->has('user_id')) {
            $cql = sprintf('match (k:User)-[:like]->(m:Product) where id(k)=%d return distinct m', session('user_id'));
            $ilikesnum = $this->entityManager->createQuery($cql)
                ->addEntityMapping('k', User::class)
                ->execute();
            $ilikes = count($ilikesnum);
        } else {
            $ilikes = 0;
        }
        return view('Product.ProductDetails')->with(array('product' => $productDetail, 'product_id' => $id,
            'mess' => $mess, 'ilikes' => $ilikes, 'phone_num' => $phone_num, 'userProducts' => $userProducts));
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function product_message($id)
    {
        $cql = sprintf('match (n:Product)-[:mes]->(m:Message) where id(n)=%d return m',$id);
        $mess = $this->entityManager->createQuery($cql)
            ->addEntityMapping('m', Message::class)
            ->execute();
        $messContent = array();
        foreach ($mess as $mes)
        {
            $Sender = $this->userRepository->findOneById($mes->getSenderId());
            $SenderName = $Sender->getNickName();
            $mesContent = $mes->getMes();
            $mesContent['senderName']=$SenderName;//组装头
            $cql_m = sprintf('match (n:Message)-[*]->(m:Message) where id(n) = %d return m;',$mes->getId());
            $replay_mess = $this->entityManager->createQuery($cql_m)
                ->addEntityMapping('m', Message::class)
                ->execute();
            $repaly = array();
            foreach ($replay_mess as $replay_m)
            {
                $replay_m_Sender = $this->userRepository->findOneById($replay_m->getSenderId());
                $replay_m_SenderName = $replay_m_Sender->getNickName();
                $replay_m_Receiver = $this->userRepository->findOneById($replay_m->getReceiverId());
                $replay_m_ReceiverName = $replay_m_Receiver->getNickName();
                $replay_mesContent=$replay_m->getMes();
                $replay_mesContent['senderName']=$replay_m_SenderName;
                $replay_mesContent['receiverName']=$replay_m_ReceiverName;
                $repaly[]=$replay_mesContent;
            }
            $messContent[] = array(
                'leave'=>$mesContent,
                'replay'=>$repaly
            );
        }
        return $messContent;
    }

    /**
     * 二维数组根据某个字段排序
     * @param array $array 要排序的数组
     * @param string $keys 要排序的键字段
     * @param int $sort 排序类型  SORT_ASC     SORT_DESC
     * @return array 排序后的数组
     */
    public function arraySort($array, $keys, $sort = SORT_DESC)
    {
        $keysValue = [];
        foreach ($array as $k => $v) {
            $keysValue[$k] = $v[$keys];
        }
        array_multisort($keysValue, $sort, $array);
        return $array;
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function search(Request $request)
    {
        if (session()->has('user_id')) {
            $cql = sprintf('match (k:User)-[:like]->(m:Product) where id(k)=%d return distinct m', session('user_id'));
            $ilikesnum = $this->entityManager->createQuery($cql)
                ->addEntityMapping('k', User::class)
                ->execute();
            $ilikes = count($ilikesnum);
        } else {
            $ilikes = 0;
        }
        $search_name = $request->get('search');
        if ($search_name) {
            //MATCH (n:Product) where n.title =~ ".*(?i)手机.*" or ANY (ax in n.label where ax =~ ".*(?i)手机.*") RETURN n
            $cql = sprintf("MATCH (n:Product) where n.title =~ '.*(?i)%s.*' or ANY (ax in n.label where ax =~ '.*(?i)%s.*') RETURN n", $search_name, $search_name);
            if($search_name=='all')
            {
                $cql = "match (n:Product) return n";
            }
            try {
                $result = $this->entityManager->createQuery($cql)
                    ->addEntityMapping('n', Product::class)
                    ->execute();
                //dd($products);
                $products = array();
                foreach ($result as $a) {
                    $products[] = $a->get_product();
                }
                //dd(arsort($products));
                $b = $this->arraySort($products, 'price', SORT_DESC);
                //dd($b);

                return view('Product.ProductSearch')->with(['products' => $products, 'ilikes' => $ilikes]);
            }catch (Exception $e)
            {
                echo "<script>alert('搜索关键词错误！');window.location.href = window.history.back();</script>";
            }

        } else {
            echo "<script>alert('搜索关键词为空！');window.location.href = window.history.back();</script>";
            //return view('Product.ProductSearch')->with(['products' => array(), 'ilikes' => $ilikes]);
        }
    }

    /**
     * 删除商品，仅将状态设为 1
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteProduct(Request $request, $id)
    {
        $cql = sprintf('match (n:Product) where id(n)=%d set n.status=1;', (int)$id);
        $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        return back()->with('delete', 1);
    }

    /**
     * 删除商品
     *
     * @param Request $request
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteProductNode(Request $request, $id)
    {
        $cql = sprintf('match p=(n:Product)-[*]->(:Message) where id(n)=%d  detach delete p;', (int)$id);
        $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $cql2 = sprintf('match (n:Product) where id(n)=%d  detach delete n;', (int)$id);
        $this->entityManager->createQuery($cql2)
            ->addEntityMapping('n', Product::class)
            ->execute();
        return 1;
    }

    /**
     * 删除我收藏的商品
     *
     * @param Request $request
     * @param $id
     * @return int
     * @throws Exception
     */
    public function deleteIwantProduct(Request $request, $id)
    {
        $cql = sprintf('match (n:User)-[l:like]->(m:Product) where id(n)=%d and id(m)=%d detach delete l;', session('user_id'), (int)$id);
        $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        return 1;
    }

    public function testMessage()
    {
        $myproducts = $this->entityManager->createQuery('match (k:User)-[:mes]->(n:Message)-[*]->(m:Message) return k,n,m')
            ->addEntityMapping('k', User::class)
            ->addEntityMapping('n', Message::class)
            ->addEntityMapping('m', Message::class)
            ->execute();
        //dd(array($myproducts));
        foreach ($myproducts as $mes) {
            echo 'k:' . ($mes['k']->getNickName()) . ' ';
            echo 'n:' . ($mes['n']->getMessage()) . ' ';
            echo 'm:' . $mes['m']->getMessage() . '<br/>';
        }
    }

    /**
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function showfind(Request $request)
    {
        if (session()->has('user_id')) {
            $cql = sprintf('match (k:User)-[:like]->(m:Product) where id(k)=%d return distinct m', session('user_id'));
            $ilikesnum = $this->entityManager->createQuery($cql)
                ->addEntityMapping('k', User::class)
                ->execute();
            $ilikes = count($ilikesnum);
        } else {
            $ilikes = 0;
        }

        //MATCH (n:Product) where n.title =~ ".*(?i)手机.*" or ANY (ax in n.label where ax =~ ".*(?i)手机.*") RETURN n
        $result = $this->entityManager->createQuery('match (n:User)-[:find]->(m:Product) where m.status=0 return distinct m')
            ->addEntityMapping('n', User::class)
            ->addEntityMapping('m', Product::class)
            ->execute();
        //dd($products);
        $products = array();
        foreach ($result as $a) {
            $products[] = $a->get_product();
        }
        //dd(arsort($products));
        $b = $this->arraySort($products, 'price', SORT_DESC);
        //dd($b);
// Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($products);
        // Define how many items we want to be visible in each page
        $perPage = 50;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());
        return view('Product.ProductFind')->with(['products' => $paginatedItems, 'ilikes' => $ilikes]);

    }
}
