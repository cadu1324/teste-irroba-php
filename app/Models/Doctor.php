<?php

namespace App\Models;

class Doctor extends BaseModel
{
    protected $table = 'doctors';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'especialidade',
        'crm',
        'telefone',
        'email',
    ];


    public function schedulings()
    {
        return $this->hasMany(Scheduling::class, 'doctor_id');
    }
}