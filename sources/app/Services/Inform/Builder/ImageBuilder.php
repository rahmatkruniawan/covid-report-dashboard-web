<?php

namespace App\Services\Inform\Builder;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ImageFileModel;

class ImageBuilder implements InformInterface
{
    private $request;
    private $image_file_name;
    private $image_file_model;
    private $image_directory = 'public/images/report';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->image_file_model = new ImageFileModel($this->request);
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
        $this->image_file_model->setFiles($this->image_file_name);
    }

    private function storeImageToDirectory()
    {
        try {
            $this->request->file('images')->storeAs($this->image_directory, $this->image_file_name);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    private function setImageName()
    {
        $imageExtension = '.' . $this->request->file('images')->extension();
        $this->image_file_name = $this->image_file_model->getLaporId() .
            '_' .
            Carbon::now()->format('YmdHis') .
            $imageExtension;
    }
}
