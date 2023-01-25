@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" class="d-flex justify-content-center">#</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Tarefa</th>
                            <th scope="col" class="d-flex justify-content-center">Data Final para Conclusão</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <th scope="row" class="d-flex justify-content-center">{{ $tarefa->id }}</th>
                                <td align="center">{{ $tarefa->user_id }}</td>
                                <td>{{ $tarefa->tarefa }}</td>
                                <td class="d-flex justify-content-center">{{ date('d/m/Y', strtotime($tarefa->data_final)) }}</td>
                            </tr>
                        @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
