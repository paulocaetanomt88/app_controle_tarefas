<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class TarefaController extends Controller
{
    // Requerindo autenticação de usuário
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);

        return view('tarefa.index', ['tarefas'=>$tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // recebendo os campos 'tarefa' e 'data_final' vindos do formulário
        $dados = $request->all('tarefa', 'data_final');

        $regras = [
            'tarefa' => 'required|min:6|max:255',
            'data_final' => 'required|date'
        ];

        $feedback = [
            'required' => 'O campo :attribute é necessário.',
            'date' => 'A data não está em formato válido',
            'tarefa.min' => 'O título da tarefa precisa ter no mínimo 6 caracteres',
            'tarefa.max' => 'O título da tarefa precisa ter no máximo 255 caracteres'
        ];
        
        // recuperando o id e o email do usuário logado vindos da session e definindo em suas respectivas variáveis
        $dados['user_id'] = auth()->user()->id;
        $destinatario = auth()->user()->email;

        $request->validate($regras, $feedback);
        
        // criando a tarefa no banco de dados
        $tarefa = Tarefa::create($dados);

        // enviando email para destinatário  a nova tarefa criada
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        // redirecionando o navegador para a rota de exibição de tarefa passando o id da tarefa
        return redirect()->route('tarefa.show', ['tarefa'=>$tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa'=>$tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;

        if ($id_usuario !== $tarefa->user_id) {
            die(view('acesso-negado'));
        }

        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;

        if ($id_usuario !== $tarefa->user_id) {
            die(view('acesso-negado'));
        }

        $regras = [
            'tarefa' => 'required|min:6|max:255',
            'data_final' => 'required|date'
        ];

        $feedback = [
            'required' => 'O campo :attribute é necessário.',
            'date' => 'A data não está em formato válido',
            'tarefa.min' => 'O título da tarefa precisa ter no mínimo 6 caracteres',
            'tarefa.max' => 'O título da tarefa precisa ter no máximo 255 caracteres'
        ];

        $request->validate($regras, $feedback);

        $tarefa->update($request->all());

        return redirect()->route('tarefa.show', ['tarefa'=>$tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;

        if ($id_usuario !== $tarefa->user_id) {
            die(view('acesso-negado'));
        }

        $tarefa->delete();

        return redirect()->route('tarefa.index');
    }

    public function exportar($extensao)
    {
        if(in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
            return Excel::download(new TarefasExport, 'tarefas.'.$extensao);
        } else {
            die('Formato inválido!');
        }

        return redirect()->route('tarefa.index');
    }
}
