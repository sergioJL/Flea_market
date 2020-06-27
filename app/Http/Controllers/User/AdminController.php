<?php

namespace App\Http\Controllers\User;

use App\model\Announcement;
use App\model\Product;
use App\model\User;
use App\model\Message;
use Couchbase\UserSettings;
use Exception;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class AdminController extends Controller
{
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
     * @param Request $request
     * @param string $type
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getProducts(Request $request, $type = 'sell')
    {
        //$cql='';
        if ($type == 'sell') {
            $cql = "match (m:User)-[:出售]->(n:Product) return n ;";
        } else {
            $cql = "match (m:User)-[:find]->(n:Product) return n ;";
        }
        $myproducts = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', Product::class)
            ->execute();
        $products = array();
        //array_push($a,"blue","yellow")
        foreach ($myproducts as $product) {
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
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('Admin.productlist')->with(['products' => $paginatedItems, 'type' => $type]);
    }

    /**
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getUsers(Request $request)
    {
        $cql = "match (n:User) return n;";
        $Users = $this->entityManager->createQuery($cql)
            ->addEntityMapping('n', User::class)
            ->execute();
        $users = array();
        //array_push($a,"blue","yellow")
        foreach ($Users as $user) {
            $users[] = $user->getUser();
        }
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($users);
        // Define how many items we want to be visible in each page
        $perPage = 15;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('Admin.userlist')->with('users', $paginatedItems);
    }

    /**
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getMessages(Request $request)
    {
        $cql = "match (m:Product)-[*]->(k:Message) return m,k;";
        $result = $this->entityManager->createQuery($cql)
            ->addEntityMapping('m', Product::class)
            ->addEntityMapping('k', Message::class)
            ->execute();
        $Messages = array();
        foreach ($result as $r)
        {
            $mess = $r['k']->getMes();
            $Messages[] = array(
                'sender' => $this->userRepository->findOneById($mess['senderid'])->getName(),
                'product' => $r['m']->get_product(),
                'message' => $mess['content'],
                'id' => $r['k']->getId()
            );
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($Messages);
        // Define how many items we want to be visible in each page
        $perPage = 15;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('Admin.messagelist')->with('Messages', $paginatedItems);
    }

    /**
     * @param Request $request
     * @return Factory|Application|View
     * @throws Exception
     */
    public function getNotice(Request $request)
    {
        $cql = "match (m:Anno) return m ORDER BY m.time DESC;";
        $annos = $this->entityManager->createQuery($cql)
            ->addEntityMapping('m', Announcement::class)
            ->execute();
//        $annos = $this->annoRepository->findAll();
        $notices = array();
        foreach ($annos as $anno)
        {
            $notices[]=$anno->getAnno();
        }
        // dd($notices);
        return view('Admin.notices')->with('notices',$notices);
    }


    public function getTobeProcessed(Request $request)
    {

    }

    public function addAnnouncement(Request $request){
        if($request->method()=='POST')
        {
            $this->validate($request, [
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'title' => 'required',
                'article-ckeditor' => 'required',
            ]);
            $ann = new Announcement($request->get('title'),$request->get('article-ckeditor'));
            $this->entityManager->persist($ann);
            $this->entityManager->flush();
            echo '<script>alert("操作成功");window.location.href ="/admin/tobeprocess"; </script>';
        }
        else
        {
            return view('Admin.announcement');
        }
    }

    /**
     * @param Request $request
     * @return Factory|Application|RedirectResponse|View
     */
    public function login(Request $request)
    {
        if ($request->method()=='POST')
        {
            $this->validate($request, [
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'id' => 'required',
                'psd' => 'required',
            ]);
            if($request->get("id")=='root'&&$request->get('psd')=='rootroot')
            {
                echo 'OK';
                return redirect('/admin/userlist');
            }
            else
            {
                return view('Admin.login');
            }
        }
        else
        {
            return view('Admin.login');
        }
    }

}
