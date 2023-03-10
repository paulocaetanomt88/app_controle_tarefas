@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex">
                    <div class="mr-auto p-2"><h4>Tarefas</h4></div>
                    <div class="p-2"><a  href="{{ route('tarefa.create') }}">Registrar Nova</a></div>
                  </div>
                  <div class="d-flex justify-content-end">
                    <div class="p-2">Exportar para:</div>
                    <div class="p-2"><a href="{{ route('tarefas.exportar', ['extensao'=>'csv']) }}" >CSV</a></div>
                    <div class="p-2"><a href="{{ route('tarefas.exportar', ['extensao'=>'xlsx']) }}" >XLSX</a></div>
                    <div class="p-2"><a href="{{ route('tarefas.exportar', ['extensao'=>'pdf']) }}" >PDF</a></div>
                    <div class="p-2"><a href="{{ route('tarefas.dompdf') }}" target="_blank">PDF V2</a></div>
                  </div>
                </div>

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
                                <td>
                                  <form id="form_{{$tarefa->id}}" method="POST" action="{{ route('tarefa.destroy', ['tarefa'=>$tarefa->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">[x]</a>
                                  </form>
                                </td>
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
