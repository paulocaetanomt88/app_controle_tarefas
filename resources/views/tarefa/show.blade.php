@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dados da Tarefa: </div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Descrição:</label>
                            <input type="text" class="form-control" value="{{$tarefa->tarefa}}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data final para conclusão:</label>
                            <input type="date" class="form-control" value="{{$tarefa->data_final}}">
                        </div>
                    </fieldset>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
