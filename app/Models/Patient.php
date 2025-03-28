<?php

namespace App\Models;

class Patient extends BaseModel
{
    protected $table = 'patients';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
    ];


    public function schedulings()
    {
        return $this->hasMany(Scheduling::class, 'paciente_id');
    }
}