<?php

namespace App\model;

use Cassandra\Date;
use GraphAware\Neo4j\OGM\Common\Collection;
use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use Doctrine\Common\Collections\ArrayCollection;
use App\model\UPLink;
use App\model\UPLike;
use App\model\Product;

/**
 * Class User
 * @package App\model
 * @OGM\Node(label="User")
 */
class User extends Model
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $student_id;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $name;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $nickname;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $psd;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $college;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $profession;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $start_year;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $phone_num;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $register_date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStudent_id()
    {
        return $this->student_id;
    }

    /**
     * @OGM\Relationship(relationshipEntity="UPLink", type="RATED", direction="OUTGOING", collection=true)
     * @var UPLink[]|ArrayCollection
     */
    protected $link;

    /**
     * @OGM\Relationship(relationshipEntity="UPLike", type="RATED", direction="OUTGOING", collection=true)
     * @var UPLike[]|ArrayCollection
     */
    protected $i_want;

    /**
     * @var Collection
     * @OGM\Relationship(relationshipEntity="Message", type="RATED", direction="OUTGOING", collection=true)
     */
    //protected $messages;

    /**
     * User constructor.
     * @param $student_id
     * @param $name
     * @param $nickname
     * @param $psd
     * @param $college
     * @param $profession
     * @param $start_year
     * @param $phone_num
     */
    public function __construct($student_id, $name, $nickname, $psd, $college, $profession, $start_year, $phone_num)
    {
        $this->student_id=$student_id;
        $this->name=$name;
        $this->nickname=$nickname;
        $this->psd=$psd;
        $this->college=$college;
        $this->profession=$profession;
        $this->start_year=$start_year;
        $this->phone_num=$phone_num;
        $this->register_date = date('Y-m-d');
        $this->link=new ArrayCollection();
        $this->i_want=new ArrayCollection();
        //$this->messages=new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return array(
            'id' => $this->id,
            'student_id' => $this->student_id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'college' => $this->college,
            'profession' => $this->profession,
            'start_year' => $this->start_year,
            'phone_num' => $this->phone_num,
            'register_date'=>$this->register_date
        );
    }

    /**
     * @return string
     */
    public function getNickName()
    {
        return $this->nickname;
    }

    /**
     * @return UPLink[]|ArrayCollection
     */
    public function getMyproduct()
    {
        return $this->link;
    }

    /**
     * @param \App\model\Product $product
     */
    public function addNode(Product $product)
    {
        $this->link->add(new UPLink($this, $product));
    }

    /**
     * @param \App\model\Product $product
     */
    public function addIwantNode(Product $product)
    {
        $this->i_want->add(new UPLike($this, $product));
    }

    /**
     * @return string
     */
    public function getPsd()
    {
        return $this->psd;
    }

    /**
     * @param $psd
     */
    public function setPsd($psd)
    {
        $this->psd = $psd;
    }

    /**
     * @return array[]
     */
    public function getName()
    {
        return array(
            'name'=>$this->name,
            'nickname'=>$this->nickname
        );
    }

    public function setNickName($name)
    {
        $this->nickname=$name;
    }
    /**
     * @return string
     */
    public function get_phonenum()
    {
        return $this->phone_num;
    }

    /**
     * @param $phonenum
     */
    public function setPhoneNum($phonenum)
    {
        $this->phone_num = $phonenum;
    }
}
