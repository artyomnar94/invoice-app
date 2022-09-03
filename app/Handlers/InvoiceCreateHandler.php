<?php

namespace App\Handlers;

use App\Http\Requests\HooksRequest;
use App\Http\Requests\InvoiceCreateRequest;
use App\Interfaces\InvoiceCreatable;
use App\Interfaces\InvoiceEntityable;
use App\Models\Hooks;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceCreateHandler implements InvoiceCreatable
{
    public function __construct(private readonly InvoiceCreateRequest $request)
    {}

    public function invoiceCreate(): InvoiceEntityable
    {
        $this->request->validated();
        try {
            DB::beginTransaction();
            $invoiceEntity = Invoice::create($this->getInvoiceFields());
            DB::commit();
            return $invoiceEntity;
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new Exception();
        }
    }

    private function getInvoiceFields(): array
    {
        $baseFields = $this->request->except(['hooks']);
        $baseFields['hook_id'] = $this->insertHook();
        return $baseFields;
    }

    private function insertHook(): int
    {
        /**
         * @var Hooks $hook
         */
        $hook = Hooks::create($this->request->all(['hooks'])['hooks']);
        return $hook->id;
    }
}
