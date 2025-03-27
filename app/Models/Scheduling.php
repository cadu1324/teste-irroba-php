<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Scheduling extends BaseModel // Estende BaseModel ou Model
{
    protected $table = 'consultas'; // Especifica o nome da tabela
    protected $primaryKey = 'id'; // Especifica a chave primária
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
        return $this->belongsTo(Patient::class, 'paciente_id'); // Especifica a chave estrangeira
    }

    // Relacionamento com a tabela de médicos
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'medico_id'); // Especifica a chave estrangeira
    }
}