<?php

namespace App\Models;

class Scheduling extends BaseModel
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'data_hora',
        'status',
    ];

    // Relacionamento com a tabela de pacientes
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'paciente_id');
    }

    // Relacionamento com a tabela de médicos
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'medico_id');
    }
}