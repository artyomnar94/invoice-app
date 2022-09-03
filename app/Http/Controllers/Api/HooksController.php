<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\HooksRequest;
use App\Http\Resources\HooksResource;
use App\Http\Resources\InvoiceResource;
use App\Models\Hooks;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

class HooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    #[Route("/invoice/api/hooks", methods: ["GET"])]
    public function index()
    {
        return HooksResource::collection(Hooks::all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return HooksResource
     * @throws ModelNotFoundException
     */
    #[Route("/invoice/api/hooks/{id}", methods: ["GET"])]
    public function show($id)
    {
//        return new HooksResource(Hooks::with('merchant')->with('hook')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HooksRequest $request
     * @param Hooks $hooks
     * @return InvoiceResource
     */
    #[Route("/invoice/api/hooks", methods: ["POST"])]
    public function update(HooksRequest $request, Hooks $hooks)
    {
        $hooks->update($request->validated());
        return new InvoiceResource($hooks);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hooks $hooks
     * @return Response
     */
    #[Route("/invoice/api/hooks", methods: ["POST"])]
    public function destroy(Hooks $hooks)
    {
        $hooks->delete();
        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
