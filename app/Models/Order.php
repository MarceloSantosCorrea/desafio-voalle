<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'string';

    const STATUS_CANCELED = 'canceled';
    const STATUS_FINALIZED = 'finalized';
    const STATUS_OPEN = 'open';

    protected $fillable = [
        'user_id',
        'client_id',
        'quantity',
        'total',
        'status',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'total'    => 'decimal:2',
    ];

    public static function create(array $attributes = [])
    {
        [$quantity, $total] = self::getQuantityAndTotalSum($attributes['items']);

        $data = [
            'user_id'   => \Auth::user()->id,
            'client_id' => $attributes['client'],
            'quantity'  => $quantity,
            'total'     => $total,
            'status'    => self::STATUS_OPEN,
        ];

        $order = self::query()->create($data);

        foreach ($attributes['items'] as $productId => $value) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity'   => $value['quantity'],
            ]);
        }

        return $order;
    }

    public function update(array $attributes = [], array $options = [])
    {
        [$quantity, $total] = self::getQuantityAndTotalSum($attributes['items']);

        $data = [
            'client_id' => $attributes['client'],
            'quantity'  => $quantity,
            'total'     => $total,
        ];

        parent::update($data, $options);

        $ids = [];
        foreach ($attributes['items'] as $productId => $value) {
            $item = $this->items->filter(function ($item) use ($productId) {
                return $item->product_id == $productId;
            })->first();

            if (is_null($item)) {
                $newItem = $this->items()->create([
                    'product_id' => $productId,
                    'quantity'   => $value['quantity'],
                ]);
                $ids[] = $newItem->id;
            } else {
                $item->update([
                    'product_id' => $productId,
                    'quantity'   => $value['quantity'],
                ]);

                $ids[] = $item->id;
            }
        }

        OrderItem::query()->whereKeyNot($ids)->where('order_id', $this->id)->delete();

        return $this;
    }

    public static function getQuantityAndTotalSum(array $products)
    {
        $total = 0;
        $quantity = 0;
        foreach ($products as $value) {
            $total = $total + ($value['quantity'] * $value['price']);
            $quantity = $quantity + $value['quantity'];
        }

        return [$quantity, $total];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function canceled()
    {
        $this->status = self::STATUS_CANCELED;
        $this->save();
    }

    public function finalized()
    {
        $this->status = self::STATUS_FINALIZED;
        $this->save();
    }

    public function open()
    {
        $this->status = self::STATUS_OPEN;
        $this->save();
    }
}
