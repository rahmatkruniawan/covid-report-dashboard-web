<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ImageFileModel extends Model
{
    protected $table = 'file_lapor';
    private $request = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setLaporId(?int $laporId)
    {
    	$this->lapor_id = $laporId;
    }

    public function setFiles(?string $files)
    {
    	$this->files = $files;
    }

    public function getLaporId()
    {
    	return $this->request['lapor_id'];
    }

    public function getFilesName()
    {
    	return $this->request['images'];
    }
}
