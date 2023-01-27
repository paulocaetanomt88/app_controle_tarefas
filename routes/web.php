<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

Route::get('/home', [TarefaController::class, 'index'])
        ->name('home')
        ->middleware('verified');


// O Controllers TarefaController foi gerado especificando a sua model Tarefa
// php artisan make:controller --resource TarefaController --model=Tarefa
Route::resource('/tarefa', TarefaController::class)
        ->middleware('verified');

Route::get('/mensagem-teste', function() {
    return new MensagemTesteMail();
    // Mail::to('paulocaetanomt88@gmail.com')->send(new MensagemTesteMail());
    // return "Email enviado!";
});

Route::get('/tarefas/exportar/{extensao}', [TarefaController::class, 'exportar'])->name('tarefas.exportar');
Route::get('/tarefas/dompdf', [TarefaController::class, 'dompdf'])->name('tarefas.dompdf');