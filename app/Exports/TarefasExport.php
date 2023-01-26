<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
class TarefasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //Outra forma usando o relacionamento entre as models User e Tarefa:
         // return auth()->user()->tarefas()->get();
        
         // Forma usando ORM do Laravel Model::where('campo_da_tabela', valor) 
        return Tarefa::where('user_id', auth()->user()->id)->get();
    }
}
