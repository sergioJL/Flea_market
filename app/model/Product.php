<?php

namespace App\model;

use DateTime;
use GraphAware\Neo4j\OGM\Common\Collection;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Product
 * @package App\model
 * @OGM\Node(label="Product")
 */
class Product extends Model
{
    //
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $title;

    /**
     * @var array
     * @OGM\Property(type="array")
     */
    protected $label;

    /**
     * @var int
     * @OGM\Property(type="int")
     */
    protected $price;

    /**
     * @var string
     * @OGM\Property(type="string")
     */
    protected $description;

    /**
     * @var array
     * @OGM\Property(type="array")
     */
    protected $image;

    /**
     * @var int
     * @OGM\Property(type="int")
     */
    protected $status;

    /**
     * @var DateTime
     *
     * @OGM\Property()
     * @OGM\Convert(type="datetime", options={"format":"long_timestamp"})
     */
    protected $time;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Product constructor.
     * @param $title
     * @param $label
     * @param $price
     * @param $description
     * @param $image
     */
    public function __construct($title = null, $label = null, $price = null, $description = null, $image = null)
    {
        $this->title = $title;
        $this->label = $label;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->status = 0;
        //$this->time = date('Y-m-d H:i:s');
        $this->time = DateTime::createFromFormat('Y-m-d H:i:s', date(now()));
    }

    /**
     * @return array
     */
    public function get_product()
    {
        return array(
            'id'=>$this->id,
            'title' => $this->title,
            'label' => $this->label,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
            'status' =>$this->status,
            'time'=>$this->time
        );
    }

    /**
     * @param array $product
     */
    public function set_product(array $product)
    {
        $this->title = $product['title'];
        $this->label = $product['label'];
        $this->price = $product['price'];
        $this->description = $product['description'];
        $this->image = $product['image'];
    }

    public function setPrice($price)
    {
        $this->price = (int)$price;
    }
}
