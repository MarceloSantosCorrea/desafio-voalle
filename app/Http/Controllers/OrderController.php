<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Dompdf\Options;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Dompdf\Dompdf;

class OrderController extends Controller
{
    use TraitCrud;

    /**
     * @var Model
     */
    private $model = Order::class;
    private $route = 'orders';
    private $data = [];

    public function create()
    {
        $this->data['clients'] = Client::all();
        $this->data['products'] = Product::all();

        return view("pages.{$this->route}.create", $this->data);
    }

    public function store(OrderCreateRequest $request): RedirectResponse
    {
        $this->model::create($request->all());

        return redirect()->route('orders.index')->with('success', __(':attribute created successfully', [
            'attribute' => __('Order'),
        ]));
    }

    public function show(Order $order)
    {
        $items = [];
        if ($order->items->count()) {
            foreach ($order->items as $item) {
                $items[$item->product->id] = [
                    'quantity' => $item->quantity,
                    'name'     => $item->product->name,
                    'price'    => $item->product->price,
                ];
            }
        }

        $this->data['order'] = $order;
        $this->data['items'] = $items;

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pages.orders.show', $this->data));

        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream(__('Order') . " - {$order->id}.pdf", ['Attachment' => false]);
    }

    public function edit(Order $order)
    {
        $this->data['clients'] = Client::all();
        $this->data['order'] = $order;
        $this->data['products'] = Product::all();

        $items = [];
        if ($order->items->count()) {
            foreach ($order->items as $item) {
                $items[$item->product->id] = [
                    'quantity' => $item->quantity,
                    'name'     => $item->product->name,
                    'price'    => $item->product->price,
                ];
            }
        }

        $this->data['items'] = $items;

        return view('pages.orders.update', $this->data);
    }

    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', __(':attribute updated successfully', [
            'attribute' => __('Order'),
        ]));
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->items->each(function($item){
            $item->delete();
        });
        $order->delete();

        return redirect()->route('orders.index')->with('success', __(':attribute deleted successfully', [
            'attribute' => __('Order'),
        ]));
    }
}
