<?php

namespace App\Core;

use App\Models\Media;
use Eventviva\ImageResize;
use FileUpload\FileUpload;
use FileUpload\PathResolver\Simple as PathResolver;
use FileUpload\FileSystem\Simple as FileSystem;
use FileUpload\Validator\Simple as Validator;
use FileUpload\FileNameGenerator\Random as FileNameGenerator;

/**
 * Class Library
 *
 * @package App\Core
 */
class Library
{
    /**
     * @var string
     */
    public $uploadPath;

    /**
     * @var int
     */
    public $maxSize;

    /**
     * @var array
     */
    public $mimeTypes;

    /**
     * @var array
     */
    public $resizeTo;

    /**
     * @var int
     */
    public $minWidth;

    /**
     * @var int
     */
    public $maxWidth;

    /**
     * @var int
     */
    public $minHeight;

    /**
     * @var int
     */
    public $maxHeight;

    /**
     * @var Application
     */
    protected $app;

    /**
     * Library constructor.
     *
     * @param $config
     */
    public function __construct($app, $config)
    {
        $this->app = $app;

        $this->uploadPath = $config['uploadPath'];
        $this->maxSize = $config['maxSize'];
        $this->mimeTypes = $config['mimeType'];
        $this->resizeTo = $config['resizeTo'];
        $this->minWidth = $config['minWidth'];
        $this->maxWidth = $config['maxWidth'];
        $this->minHeight = $config['minHeight'];
        $this->maxHeight = $config['maxHeight'];
    }

    /**
     * @param string $name
     *
     * @return Media|null
     * @throws \Eventviva\ImageResizeException
     */
    public function uploadImage($name)
    {
        $fileupload = new FileUpload($_FILES[$name], $_SERVER);

        $validator = new Validator($this->maxSize, $this->mimeTypes);
        $pathresolver = new PathResolver($this->uploadPath);
        $filesystem = new FileSystem();
        $filenamegenerator = new FileNameGenerator();

        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);
        $fileupload->setFileNameGenerator($filenamegenerator);

        list($files, $headers) = $fileupload->processAll();

        $media = new Media($this->app->getDb());

        foreach ($files as $file) {
            if ($file->error) {
                $media->addError('filename', $file->error);
                return $media;
            };
            if ($file->completed) {
                $filePath = $file->getRealPath();
                $image = new ImageResize($filePath);
                $image->resizeToBestFit($this->resizeTo[0], $this->resizeTo[1]);
                $image->save($filePath);

                $imageInfo = getimagesize($filePath);

                $media->size = $file->getSize();
                $media->mime_type = $file->getMimeType();
                $media->filename = '/' . $file->getFilename();
                $media->width = $imageInfo[0];
                $media->height = $imageInfo[1];

                $media->save(false);
            }
        }

        return $media;
    }
}
