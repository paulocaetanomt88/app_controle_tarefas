@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tarefa.store') }}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Tarefa</label>
                          <input type="text" class="form-control" name="tarefa">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data final para conclusão:</label>
                            <input type="date" class="form-control" name="data_final">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
