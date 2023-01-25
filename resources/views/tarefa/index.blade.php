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
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <th scope="row" class="d-flex justify-content-center">{{ $tarefa->id }}</th>
                                <td align="center">{{ $tarefa->user_id }}</td>
                                <td>{{ $tarefa->tarefa }}</td>
                                <td class="d-flex justify-content-center">{{ date('d/m/Y', strtotime($tarefa->data_final)) }}</td>
                                <td><a href="{{route('tarefa.edit', $tarefa->id)}}">[e]</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          <li class="page-item {{ $tarefas->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link " href="{{ $tarefas->previousPageUrl() }}" >Anterior</a>
                          </li>

                          @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                            <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}" >
                              <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                            </li>
                          @endfor

                          <li class="page-item {{ $tarefas->currentPage() == $tarefas->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Próxima</a>
                          </li>
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
