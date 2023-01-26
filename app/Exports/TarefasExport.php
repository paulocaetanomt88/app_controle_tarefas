<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TarefasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //Outra forma usando o relacionamento entre as models User e Tarefa:
         // return auth()->user()->tarefas()->get();
        
         // Forma usando ORM do Laravel Model::where('campo_da_tabela', valor) 
        return Tarefa::where('user_id', auth()->user()->id)->get(['id','user_id','tarefa','data_final','created_at','updated_at']);
    }

    public function headings(): array // declarando o tipo de retorno (tipo array)
    {
        return ['ID da Tarefa','ID do Usuário','Tarefa', 'Data final para conclusão','Criada em','Atualizada em'];
    }
}
