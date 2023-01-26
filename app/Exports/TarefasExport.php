<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
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

    public function headings(): array // declarando o tipo de retorno (tipo array)
    {
        return ['ID da Tarefa','Tarefa', 'Data final para conclusão'];
    }

    public function map($linha): array
    {
        return [
            $linha->id,
            ucfirst($linha->tarefa),
            date('d/m/Y',strtotime($linha->data_final))
        ];
    }
}
