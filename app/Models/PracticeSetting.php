<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class PracticeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'practice_name',
        'practice_tax_num',
        'practice_firstname',
        'practice_lastname',
        'practice_degree',
        'practice_website',
        'practice_tel',
        'practice_email',
        'practice_street',
        'practice_postal_code',
        'practice_province',
        'practice_iban',
        'practice_bic',
        'practice_bank'
    ];

    protected $with = [
        'practice_additional_setting:id,title,checked,practice_setting_id'
    ];

    protected $appends = array('practice_logo_url');

    public function getPracticeLogoUrlAttribute() {
        return Storage::disk('setting_logo')->url($this->practice_logo);
    }

    public function practice_additional_setting() {
        return $this->hasMany(PracticeAdditionalSetting::class);
    }
}
