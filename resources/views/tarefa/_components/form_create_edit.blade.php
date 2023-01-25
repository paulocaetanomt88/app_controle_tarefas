@if (isset($tarefa->tarefa))
    <form method="POST" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id ]) }}">
    @csrf
    @method('PUT')
@else
    <form method="POST" action="{{ route('tarefa.store') }}">
    @csrf
@endif

    <div class="mb-3">
      <label class="form-label">Tarefa</label>
      <input type="text" class="form-control" name="tarefa" value="{{ $tarefa->tarefa ?? old('tarefa') }}" placeholder="Título da tarefa"> 
      {{ $errors->has('tarefa') ? $errors->first('tarefa') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Data final para conclusão:</label>
        <input type="date" class="form-control" name="data_final" value="{{ $tarefa->data_final ?? old('data_final') }}">
    </div>
    <button type="submit" class="btn btn-primary">
        @if (isset($tarefa->tarefa))
            Atualizar
        @else
            Registrar
        @endif
    </button>
</form>