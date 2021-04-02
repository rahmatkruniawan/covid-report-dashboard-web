<?php

namespace App\Services\Inform;

use Illuminate\Http\Request;
use App\Models\InformModel;
use App\Services\Preventor\PreventionInterface;

class InformPayloadPreventor implements PreventionInterface
{
    private $inform_model;
    private $phone_number;

    protected $error;

    public function __construct()
    {
        $this->inform_model = new InformModel();
    }

    public function prevent()
    {
        $error = $this->getErrorPrevention()
        if (! empty($error)) {
            return;
        }

        return $error;
    }

    private function getErrorPrevention()
    {
        if (! $this->hasReporterName()) {
            $this->error = 'empty_reporter_name';
            return;
        }

        if (! $this->isReporterPhoneNumberMoreThanNineCharacters()) {
            $this->error = 'phone_number_less_than_nine_characters';
            return;
        }

        if (! $this->hasReporterEmail()) {
            $this->error = 'empty_reporter_email';
            return;
        }

        return;
    }

    private function hasReporterName()
    {
        if (! empty($this->inform_model->getReporterName())) {
            return true;
        }

        return false;
    }

    private function isReporterPhoneNumberMoreThanNineCharacters()
    {
        $this->phone_number = $this->inform_model->getReporterPhoneNumber();

        return $this->isPhoneNumberMoreThanNineCharacters()
    }

    private function isPhoneNumberMoreThanNineCharacters()
    {
        if (strlen($this->phoneNumber) >= 9) {
            return false;
        }

        return true;
    }

    private function hasReporterEmail()
    {
        if (! empty($this->inform_model->getReporterEmail())) {
            return true;
        }

        return false;
    }
}