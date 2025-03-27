<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Doctor extends BaseModel // Estende BaseModel ou Model
{
    protected $table = 'medicos'; // Especifica o nome da tabela
    protected $primaryKey = 'id'; // Especifica a chave primária
    public $timestamps = true; 

    protected $fillable = [
        'nome',
        'especialidade',
        'crm',
        'telefone',
        'email',
    ];

    // Relacionamento com a tabela de agendamentos
    public function schedulings()
    {
        return $this->hasMany(Scheduling::class, 'medico_id'); // Especifica a chave estrangeira
    }
}