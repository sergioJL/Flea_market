<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use App\model\User;
use App\model\Product;

/**
 * Class UPLike
 * @package App\model
 * @OGM\RelationshipEntity(type="like")
 */
class UPLike extends Model
{
    //
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;

    /**
     * @OGM\StartNode(targetEntity="User")
     * @var User
     */
    protected $user;

    /**
     * @OGM\EndNode(targetEntity="Product")
     * @var Product
     */
    protected $product;

    /**
     * UPLink constructor.
     * @param \App\model\User $user
     * @param \App\model\Product $product
     */
    public function __construct(User $user, Product $product)
    {
        $this->user = $user;
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}
