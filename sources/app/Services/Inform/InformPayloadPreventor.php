<?php

namespace App\Services\Inform;

use Illuminate\Http\Request;
use App\Models\InformModel;
use App\Services\Preventor\PreventorInterface;

class InformPayloadPreventor implements PreventorInterface
{
    private $inform_model;
    private $phone_number;

    protected $error;

    public function __construct(Request $request)
    {
        $this->inform_model = new InformModel($request);
    }

    public function prevent()
    {
        $error = $this->getErrorPrevention();

        if (is_null($error)) {
            return;
        }

        return $error;
    }

    private function getErrorPrevention()
    {
        if (! $this->hasReporterName()) {
            return 'empty_reporter_name';
        }

        if (! $this->isReporterPhoneNumberMoreThanNineCharacters()) {
            return 'phone_number_less_than_nine_characters';
        }

        if (! $this->isReporterEmailValid()) {
            return 'invalid_email';
        }

        return;
    }

    private function hasReporterName()
    {
        if (! is_null($this->inform_model->getReporterName()) ||
            $this->inform_model->getReporterName() != '') {
            return true;
        }

        return false;
    }

    private function isReporterPhoneNumberMoreThanNineCharacters()
    {
        $this->phone_number = $this->inform_model->getReporterPhoneNumber();

        return $this->isPhoneNumberMoreThanNineCharacters();
    }

    private function isPhoneNumberMoreThanNineCharacters()
    {
        if (strlen($this->phone_number) >= 9) {
            return true;
        }

        return false;
    }

    private function isReporterEmailValid()
    {
        if (filter_var($this->inform_model->getReporterEmail(), FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}