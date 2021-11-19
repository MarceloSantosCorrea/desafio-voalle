<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientCreateRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    use TraitCrud;

    /**
     * @var Model
     */
    private $model = Client::class;
    private $route = 'clients';
    private $data = [];

    public function store(ClientCreateRequest $request): RedirectResponse
    {
        $this->model::query()->create($request->all());

        return redirect()->route('clients.index')->with('success', __(':attribute created successfully', [
            'attribute' => __('Client'),
        ]));
    }

    public function edit(Client $client)
    {
        return view('pages.clients.update', compact('client'));
    }

    public function update(ClientUpdateRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', __(':attribute updated successfully', [
            'attribute' => __('Client'),
        ]));
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', __(':attribute deleted successfully', [
            'attribute' => __('Client'),
        ]));
    }
}
