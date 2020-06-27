<?php

namespace App\model;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use App\model\User;
use App\model\Product;

/**
 * Class Message
 * @package App\model
 * @OGM\Node(label="Message")
 */
class Message extends Model
{
    //
    /**
     * @var int
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     * @OGM\Property(type="string")
     */
    protected $content;

    /**
     * 0:未读 1:已读
     * @var int
     * @OGM\Property(type="int")
     */
    protected $read;

    /**
     * 发表者id
     * @var int
     * @OGM\Property(type="int")
     */
    protected $senderid;

    /**
     * 被回复者id
     * @var int
     * @OGM\Property(type="int")
     */
    protected $receiverid;

    /**
     * @var DateTime
     *
     * @OGM\Property()
     * @OGM\Convert(type="datetime", options={"format":"long_timestamp"})
     */
    protected $time;

    /**
     * Message constructor.
     * @param $messages
     * @param $senderid
     * @param null $receiverid
     */
    public function __construct($messages, $senderid, $receiverid=null)
    {
        $this->content = $messages;
        $this->read = 0;
        $this->senderid = $senderid;
        $this->receiverid = $receiverid;
        $this->time = DateTime::createFromFormat('Y-m-d H:i:s', date(now()));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->content;
    }

    public function getMes()
    {
        return array(
            'id'=>$this->id,
            'content'=>$this->content,
            'time'=>$this->time,
            'senderid'=>$this->senderid,
            'receiverid'=>$this->receiverid
        );
    }

    public function getSenderId()
    {
        return $this->senderid;
    }

    public function getReceiverId()
    {
        return $this->receiverid;
    }
}
