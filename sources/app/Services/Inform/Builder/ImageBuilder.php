<?php

namespace App\Services\Inform\Builder;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ImageFileModel;
use Illuminate\Support\Facades\Storage;

class ImageBuilder implements InformInterface
{
    private $request;
    private $image_file_name;
    private $image_file_model;
    private $image;
    public $image_name;
    private $decode_image;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->image_file_model = new ImageFileModel($this->request);
        $this->image_directory = \Config::get("images.images_directory");
    }

    public function build()
    {
        $this->setImageName();
        $this->storeImageToDirectory();
        $this->create();
        $this->image_file_model->save();
    }

    public function create()
    {
        $this->image_file_model->setLaporId($this->image_file_model->getLaporId());
        $this->image_file_model->setFiles($this->image_name);
    }

    private function storeImageToDirectory()
    {
        try {
            file_put_contents($this->image_name, $this->decode_image);

        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    private function setImageName()
    {
        $image = $this->request->input('gambar');
        preg_match("/data:image\/(.*?);/", $image,$image_extension);
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image);
        $this->image = str_replace(' ', '+', $image);
        $this->decode_image = base64_decode($this->image);
        $this->image_name = 'lapor' . time() . '.' . $image_extension[1];
    }
}
