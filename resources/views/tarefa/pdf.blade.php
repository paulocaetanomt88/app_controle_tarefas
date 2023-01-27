<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            html {
                font-family: sans-serif;
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                }

            body {
                margin: 0;
                font-family: "Nunito", sans-serif;
                font-size: 0.9rem;
                font-weight: 400;
                line-height: 1.6;
                color: #212529;
                text-align: left;
                background-color: #f8fafc;
                }
            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            .styled-table {
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                width: 100%;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }

            .styled-table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
            }

            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>
        <h2>Tarefas</h2>
        <h4>Página 1</h4>
        <table class="styled-table">
            <thead>
                <tr>
                <th scope="col" width='50' >#</th>
                <th scope="col">Usuário</th>
                <th scope="col">Tarefa</th>
                <th scope="col" >Data Final para Conclusão</th>

                </tr>
            </thead>
            <tbody>
            @foreach ($tarefas as $key => $tarefa)
                <tr>
                    <th scope="row" >{{ $tarefa->id }}</th>
                    <td align="center">{{ $tarefa->user->name }}</td>
                    <td>{{ $tarefa->tarefa }}</td>
                    <td align="center">{{ date('d/m/Y', strtotime($tarefa->data_final)) }}</td>  
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
