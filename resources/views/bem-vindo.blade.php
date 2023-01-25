Mensagem pública <br />

@auth
    <h1>Mensagem para usuário autenticado</h1>
    <p>Apenas usuários autenticados podem ver este conteúdo.</p>
@endauth

@guest
    <h1>Mensagem para visitante (não autenticado)</h1>
    <p>Todos que visitarem esta página podem ver este conteúdo.</p>
@endguest