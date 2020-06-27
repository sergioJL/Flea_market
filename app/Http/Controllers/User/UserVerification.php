<?php

namespace App\Http\Controllers\User;

use App\model\User;
use Exception;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class UserVerification
 * @package App\Http\Controllers\User
 */
class UserVerification extends Controller
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
     * UserController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * 用户登录
     *
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        if ($request->all() != null) {
            $this->validate($request, [
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'captcha' => 'required|captcha',
                'student_id' => 'required',
                'psd' => 'required'
            ]);
            $student_id = $request->get('student_id');
            $psd = $request->get('psd');
            $user = $this->userRepository->findOneBy(['student_id' => $student_id]);
            if ($user == null) {
                return back()->withInput($request->all())->withErrors(['student_id' => '你输入的账户不存在']);
            }
            if (!Hash::check($psd,$user->getPsd())) {
                return back()->withInput($request->all())->withErrors(['psd' => '密码输入错误']);
            }
            $user_id = $user->getId();
            $nickname = $user->getNickName();

            session(['user_id' => $user_id, 'nickName' => $nickname]);
            session()->save();

            return redirect('/product/showall');
        } else {
            return view('User.Login2');
        }

    }

    /**
     * 用户注册
     *
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function register(Request $request)
    {
        if ($request->all() != null) {
            if (session()->has('phone')) {
                $captcha = session()->get('phone');
            } else {
                return back()->withInput($request->all())->withErrors(['请点击获取验证码!']);
            }

            $this->validate($request, [
                //具体的规则
                //字段 => 验证规则1|验证规则2|...
                'student_id' => 'required|string|size:12',
                'name' => 'required|min:2|max:20',
                'nickname' => 'required|min:2|max:20',
                'psd' => 'required|min:5',
                'college' => 'required',
                'profession' => 'required',
                'start_year' => 'required',
                'phone_num' => 'required',
            ]);

            if ($captcha != (int)$request->get('phone_yzm')) {
                return back()->withInput($request->all())->withErrors(['验证码错误!']);
            }
            $find_user = $this->userRepository->findBy(['student_id' => $request->get('student_id')]);
            if (count($find_user) > 0) {
                return back()->withInput($request->all())->withErrors(['当前学号已被注册!']);
            }
            $user = new User(
                $request->get('student_id'),
                $request->get('name'),
                $request->get('nickname'),
                $hashStr = Hash::make($request->get('psd')),
                $request->get('college'),
                $request->get('profession'),
                $request->get('start_year'),
                $request->get('phone_num')
            );
            // return view('User.register');
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return redirect('/user/login')->with(['student_id' => $request->get('student_id')]);
            //return view('User.login2',['student_id'=>$request->get('student_id')]);
        } else {
            return view('User.register2');
        }

    }

    public function forget(Request $request)
    {
        if ($request->all() != null) {

        } else {
            return view('User.forget');
        }
    }

    /**
     * @param Request $request
     * @return UrlGenerator|Application|string
     */
    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/user/login');
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function changeNickName(Request $request)
    {
        //dd($request->all());
        if ($request->get('newnickname') != '')
        {
            $user_id = session('user_id');
            $user = $this->userRepository->findOneById($user_id);
            $user->setNickName($request->get('newnickname'));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            session(['nickName' => $request->get('newnickname')]);
            session()->save();
            echo "<script>alert('修改成功');window.location.href = '/user/safe'</script>";
        }
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function changePsd(Request $request)
    {
        $user_id = session('user_id');
        $user = $this->userRepository->findOneById($user_id);
//        if (!Hash::check($request->get('old_psd'),$user->getPsd())) {
//           // 密码错误
//            echo "<script>alert('原始密码输入错误');window.location.href = window.history.back();</script>";
//        }
        if($request->get('new_psd') != $request->get('new_psd2'))
        {
            echo "<script>alert('两次输入新密码不一致');window.location.href = window.history.back();</script>";
        }
        $user->setPsd(Hash::make($request->get('new_psd')));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        echo "<script>alert('修改成功');window.location.href ='/user/safe';</script>";
    }

    /**
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function changePhoneNum(Request $request)
    {
        $user_id = session('user_id');
        $user = $this->userRepository->findOneById($user_id);
        $old_phone = $user->get_phonenum();
        if ($old_phone != $request->get('old_phonenum'))
        {
            echo "<script>alert('原始手机号错误');window.location.href = window.history.back();</script>";
        }
        $user->setPhoneNum($request->get('new_phonenum'));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        echo "<script>alert('修改成功');window.location.href = '/user/safe';</script>";
    }
}
