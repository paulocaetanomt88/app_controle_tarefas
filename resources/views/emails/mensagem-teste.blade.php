@component('mail::message')
# Introduction

The body of your message.
 Lista 1
 <ul>
    <li>Opção 1</li>
    <li>Opção 2</li>
    <li>...</li>
 </ul>

@component('mail::button', ['url' => ''])
Texto do botão 1
@endcomponent

@component('mail::button', ['url' => ''])
Texto do botão 2
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
