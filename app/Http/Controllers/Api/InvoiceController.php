<?php

namespace App\Http\Controllers\Api;

use App\Handlers\InvoiceCreateHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceCreateRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    #[Route("/api/invoice", methods: ["GET"])]
    public function index()
    {
        return InvoiceResource::collection(Invoice::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InvoiceCreateRequest $request
     * @return InvoiceResource
     * @throws ModelNotFoundException
     */
    #[Route("/api/invoice", methods: ["POST"])]
    public function store(InvoiceCreateRequest $request)
    {
//        $invoice = Invoice::create($request->validated());
        $invoice = (new InvoiceCreateHandler($request))->invoiceCreate();
        return new InvoiceResource(Invoice::with('merchant')->with('hook')->findOrFail($invoice->getId()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return InvoiceResource
     * @throws ModelNotFoundException
     */
    #[Route("/api/invoice/{id}", methods: ["GET"])]
    public function show($id)
    {
        return new InvoiceResource(Invoice::with('merchant')->with('hook')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InvoiceUpdateRequest $request
     * @param Invoice $invoice
     * @return InvoiceResource
     */
    #[Route("/api/invoice", methods: ["POST"])]
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());
        return new InvoiceResource($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return Response
     */
    #[Route("/api/invoice", methods: ["POST"])]
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
