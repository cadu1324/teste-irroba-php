<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel // Estende BaseModel ou Model
{
    protected $table = 'pacientes'; // Especifica o nome da tabela
    protected $primaryKey = 'id'; // Especifica a chave primária
    public $timestamps = true; 

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
    ];

    // Relacionamento com a tabela de agendamentos
    public function schedulings()
    {
        return $this->hasMany(Scheduling::class, 'paciente_id'); // Especifica a chave estrangeira
    }
}