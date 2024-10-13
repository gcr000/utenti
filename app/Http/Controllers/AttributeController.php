<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = 'Numero di telefono';
        $slug = 'numero-di-telefono';
        $description = 'Il numero di telefono dell\'utente';
        $type = 'text';
        $is_required = true;

        $attribute = new Attribute();
        $attribute->name = $name;
        $attribute->slug = $slug;
        $attribute->description = $description;
        $attribute->type = $type;
        $attribute->is_required = $is_required;
        $attribute->save();


        // aggiungo lo slug al file di lingua inglese e italiano
        $en = include base_path('resources/lang/en/attributes.php');
        $en[$slug] = $name;
        file_put_contents(base_path('resources/lang/en/attributes.php'), '<?php return ' . var_export($en, true) . ';');

        $it = include base_path('resources/lang/it/attributes.php');
        $it[$slug] = $name;
        file_put_contents(base_path('resources/lang/it/attributes.php'), '<?php return ' . var_export($it, true) . ';');

        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_italiano' => 'required|string',
            'name_inglese' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'is_required' => 'nullable|boolean',
        ]);

        $attribute = new Attribute();
        $attribute->name = $validated['name_italiano'];
        $attribute->slug = Str::slug($validated['name_italiano']);
        $attribute->description = $validated['description'];
        $attribute->type = $validated['type'];
        $attribute->is_required = $validated['is_required'] ?? false;
        $attribute->save();

        $en = include base_path('resources/lang/en/attributes.php');
        $en[$attribute->slug] = ucfirst($validated['name_inglese']);
        file_put_contents(base_path('resources/lang/en/attributes.php'), '<?php return ' . var_export($en, true) . ';');

        $it = include base_path('resources/lang/it/attributes.php');
        $it[$attribute->slug] = ucfirst($validated['name_italiano']);
        file_put_contents(base_path('resources/lang/it/attributes.php'), '<?php return ' . var_export($it, true) . ';');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
