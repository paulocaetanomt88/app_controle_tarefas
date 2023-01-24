@component('mail::message')
# {{$tarefa}}

Data final para conclusão: {{ $data_final_conclusao }}

@component('mail::button', ['url' => $url])
Clique aqui para ver a tarefa
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
