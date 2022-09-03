<?php

namespace App\Models;

use App\Http\Requests\enums\InvoiceOptionEnum;
use App\Http\Requests\enums\InvoiceStateEnum;
use App\Interfaces\InvoiceEntityable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $merchant_id
 * @property InvoiceStateEnum $state
 * @property float $amount
 * @property InvoiceOptionEnum $option
 * @property int $hook_id
 * @property int $expiration_date
 * @property int $creation_date
 * @property string $description
 */
class Invoice extends Model implements InvoiceEntityable
{
    use HasFactory;

    protected $table = 'invoice';
    protected $fillable = ['merchant_id', 'amount', 'option', 'description', 'expiration_date', 'hook_id'];
    public const CREATED_AT = 'creation_date';
    public const UPDATED_AT = null;

    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id', 'merchant_id');
    }

    public function hook()
    {
        return $this->hasOne(Hooks::class, 'id','hook_id');
    }

    public function getFormattedDate(string $fieldName): string
    {
        /**
         * @var Carbon $date
         */
        $date = $this->$fieldName;
        return date('Y-m-d h:i:s', $date->timestamp);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMerchant(): Merchant
    {
        return $this->merchant();
    }

    public function getState(): InvoiceStateEnum
    {
        return $this->state;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getOption(): InvoiceOptionEnum
    {
        return $this->option;
    }

    public function getHook(): Hooks
    {
        return $this->hook();
    }

    public function getExpirationDate(): string
    {
        return $this->expiration_date;
    }

    public function getCreationDate(): string
    {
        return $this->creation_date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
