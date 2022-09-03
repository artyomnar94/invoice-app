<?php

namespace App\Interfaces;

use App\Http\Requests\enums\InvoiceOptionEnum;
use App\Http\Requests\enums\InvoiceStateEnum;
use App\Models\Hooks;
use App\Models\Merchant;

interface InvoiceEntityable
{
    public function getId(): int;

    public function getMerchant(): Merchant;

    public function getState(): InvoiceStateEnum;

    public function getAmount(): float;

    public function getOption(): InvoiceOptionEnum;

    public function getHook(): Hooks;

    public function getExpirationDate(): string;

    public function getCreationDate(): string;

    public function getDescription(): string;

}
