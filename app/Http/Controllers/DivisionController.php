<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Division;
use \App\Models\Collaborator;
use \App\Http\Requests\StoreDivisionPostRequest;

class DivisionController extends Controller
{
    // request 
    public function list(Request $request){
        $listado = Division::where('name', 'like', '%'.$request->search.'%')->orderBy('name')->paginate(10);
        
        foreach ($listado as $key => $value) {
            $listado[$key] = (object)[
                'id' => $value->id,
                'name' => $value->name,
                'name_superior' => $this->getDivisionSuperior($value->upper_division),
                'count_collaborators' => $value->count_collaborators,
                'level' => $this->getDivisionLevel($value->upper_division),
                'subdivisions' => $this->getCountSubDivisions($value->id),
                'ambassador' => $value->ambassador
            ];
        }
        return response()->json($listado, 201);
    }

    public function divisionsForSelect() {
        $data = Division::select(['id', 'name'])->get();
        return response()->json($data, 201);
    }

    public function view($id) {
        $data = Division::find($id);
        if( is_null($data)){
            return (object)[];
        }
        $data_upper = Division::find($data->upper_division);
        $data->name_upper_division = is_null($data_upper) ? '-' : $data_upper->name;

        return response()->json($data, 201);
    }

    public function store(StoreDivisionPostRequest $request) {
   
        $data =  Division::create([
            'name' => $request->name,
            'upper_division' => $request->upper_division,
            'ambassador' => $request->ambassador,
            'count_collaborators' => $request->count_collaborators
        ]);
        return response()->json($data, 201);
    }

    public function update(StoreDivisionPostRequest $request, $id) {
        $data = Division::find($id);
        $data->name = $request->name;
        $data->upper_division = $request->upper_division;
        $data->count_collaborators = $request->count_collaborators;
        $data->ambassador = $request->ambassador;
        
        return response()->json($data->update(), 201);
    }
    
    public function delete($id) {
        $data =  Division::find($id);
        return response()->json($data->delete(), 201);
    }

    public function subdivisions($id) {
        $data =  Division::where('upper_division', $id)->get();
        return response()->json($data, 201);
    }
    
    // helpers
    public function getDivisionSuperior( $superior_id) {
        $result = Division::where('id', $superior_id)->get();
        return count($result) ? $result->first()->name : '-';
    }

    public function getDivisionLevel($superior_id ,$level = 1){
        $superior = Division::where('id', $superior_id)->get();   
        $upper_division_id = count($superior) ? $superior->first()->upper_division : null;
        $level = count($superior)  ? $level + 1  : $level;
        if( is_null($upper_division_id)){
            return $level;
        }else{              
            return $this->getDivisionLevel($upper_division_id, $level);
        }
    }

    public function getCountSubDivisions(  $id ) {
        $subdivisions =  Division::where('upper_division', $id)->get();   
        return count($subdivisions);
    }

}

