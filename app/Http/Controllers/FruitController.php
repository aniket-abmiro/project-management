<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FruitController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Fruit::class, 'fruit');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Fruit::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['user_id' => 'required', 'name' => 'required', 'price' => 'required', 'expires_at' => 'required|date|after:tomorrow']);
        $new_user = Fruit::create($validated);

        return response()->json($new_user);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        // Log::debug("FruitController::show $id");
        // $user = Fruit::find();
        // if (!$user) {
        //     $user = "Fruit Not found";
        // }
        return response()->json($fruit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate(['price' => 'required']);
        $user = Fruit::find($id);
        if (! $user) {
            return response()->json('user not found');
        }
        $user->price = $request->price;

        return response()->json('updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = Fruit::find($id);

        return response()->json($user->delete());
    }
}
