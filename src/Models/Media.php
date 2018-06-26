<?php

namespace App\Models;

use App\Core\Model;


/**
 * Class Media
 *
 * @package App\models
 */
class Media extends Model
{
    /**
     * @var string
     */
    public $mime_type;

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * @var int
     */
    public $size;

    /**
     * @var string
     */
    public $filename;

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return [ 'id', 'mime_type', 'width', 'height', 'size', 'filename' ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return static::url($this->filename);
    }

    /**
     * @return string
     */
    public static function url( $filename )
    {
        return env('UPLOADS_DIR') . ( $filename ? : '/noimage.png' );
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'media';
    }
}
