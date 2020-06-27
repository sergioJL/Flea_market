<?php

namespace App\model;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * Class Message
 * @package App\model
 * @OGM\Node(label="Anno")
 */
class Announcement extends Model
{
    /**
     * @var int
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     * @OGM\Property(type="string")
     */
    protected $title;

    /**
     * @var string
     * @OGM\Property(type="string")
     */
    protected $content;

    /**
     * @var DateTime
     *
     * @OGM\Property()
     * @OGM\Convert(type="datetime", options={"format":"long_timestamp"})
     */
    protected $time;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Announcement constructor.
     * @param $title
     * @param $content
     */
    public function __construct($title ,$content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->time = DateTime::createFromFormat('Y-m-d H:i:s', date(now()));
    }

    public function getAnno()
    {
        return array(
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'time'=>$this->time->format("Y-m-d H:i:s")
        );
    }
}
