<?php

namespace App\Http\Controllers;

use App\Constants\Geral;
use App\Http\Requests\ApartamentoRequest;
use App\Services\ApartamentoService;
use Illuminate\Http\Request;

class ApartamentoController extends Controller
{
    protected $service;

    public function __construct(ApartamentoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function create(ApartamentoRequest $request)
    {
        $request['proprietario_id'] = auth()->id();
        $apartamento = $this->service->create($request);

        if($apartamento == true){
            return ['status' => true, 'message' => Geral::APARTAMENTO_CADASTRADO, 'apartamento' => $apartamento];
        } else {
            return ['status' => false, 'message' => Geral::APARTAMENTO_EXISTE, 'apartamento' => $apartamento];
        }
    }

    public function list()
    {
        $apartamento = $this->service->list();

        return ['status' => true, 'message' => Geral::APARTAMENTO_ENCONTRADO, 'apartamento' => $apartamento];
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $apartamento = $this->service->update($request, $id);

        return ['status' => true, 'message' => Geral::APARTAMENTO_ATUALIZADO, "apartamento" => $apartamento];
    }

    public function destroy(string $id)
    {
        //
    }
}
