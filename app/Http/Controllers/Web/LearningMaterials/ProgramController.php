<?php

namespace App\Http\Controllers\Web\LearningMaterials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use DataTables;
use DB;
use Log;
use Auth;
use Str;
use Carbon\Carbon;

use App\Models\LearningMaterials\Program;

use App\Http\Requests\Web\ProgramManagement\AddProgramRequest;
use App\Http\Requests\Web\ProgramManagement\EditProgramRequest;

class ProgramController extends Controller
{


    public function getPrograms(Request $request){

        // if( Auth::user()->can('view-programs')){

        //     return abort('403'); 
        // }

        if ($request->ajax()) {

            $programs = Program::leftJoin('users', 'programs.created_by', '=', 'users.id')
            ->select('programs.program_reference', 'programs.program', 'programs.description', 'users.name', 'programs.created_at')
            ->orderBy('programs.created_at', 'desc');

            return Datatables::of($programs)
            ->addIndexColumn()

            ->editColumn('created_at', function($programs){
                return date("l F d, Y @ H:i:s a", strtotime($programs->created_at));
            })   
            ->editColumn('name', function($programs){
                return ucwords($programs->name);
            })            
            ->editColumn('program', function($programs){
                return strtoupper($programs->program);
            })
            ->editColumn('description', function($programs){
                return ucwords($programs->description);
            })
             
            ->addColumn('actions', function($row){

                $actions = '<div class="d-flex gap-3">';
                
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewRecordModal" data-id ="'.$row->program_reference.'" id ="'.$row->program_reference.'" class="text-info btn-xl record-view-btn" title="View Record"><i class="icon-base ti tabler-file-text"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editRecordModal" data-id ="'.$row->program_reference.'" id ="'.$row->program_reference.'" class="text-success btn-xl record-edit-btn" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                //$actions .= '<a href="/edit-program/'.$row->program_reference.'" class="text-success btn-xl btn-edit" title="Edit Record"><i class="icon-base ti tabler-file-pencil"></i></a>';
                $actions .= '<a href="javascript:void(0);" data-id ="'.$row->program_reference.'" id ="'.$row->program_reference.'" class="text-danger btn-xl record-del-btn" title="Delete Record"><i class="icon-base ti tabler-file-x"></i></a>';

                $actions .= '</div>';
                return $actions;

            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        return view('web.program-management.view-programs' );

    }




    public function getAddProgram(){

        // $user = Auth::user();

        // if( $user->can('create-program')){

        //     return abort('403'); 
        // }

        return view('web.program-management.add-program');

    }



    public function addProgram(AddProgramRequest $request){

        // $user = Auth::user();

        // if( $user->can('create-program')){

        //     return abort('403'); 
        // }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $program = Program::create($validated);

            \DB::commit();

            return response()->json(['message' => 'Program created successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            info($e);

            return response()->json(['message' => 'Error creating Program'], 500);
        }
    
    }




    public function getviewProgram($id){

        // if( !Auth::user()->can('view-program')){

        //     return abort('403'); 
        // }

        try{

            $program = Program::where('program_reference', $id)
            ->select('program_reference', 'program', 'description', 'created_at')->first();  
            //$program = Program::where('program_reference', $request->program_reference)->first();  
            
            //info($program);
            
            // if($program === null ){
            //     $error_message = array('program_reference' => array('Program does not exist'));
            //     return response()->json([
            //         'message' => 'The given data was invalid',
            //         'errors' => $error_message
            //     ], 422);
            // }

            return response()->json(['message' => 'success', 'data'=>$program]);

        }

        catch (ModelNotFoundException $e){

            return response()->json([
                'message' => 'Program not found'
            ], 404);

        }
        
    }



    public function getUpdateProgram($id){

        // if( !Auth::user()->can('update-program')){

        //     return abort('403'); 
        // }

        try{

            $program = Program::where('program_reference', $id)->first();  
            //$program = Program::where('program_reference', $request->program_reference)->first();  
            
            //info($program);
            
            // if($program === null ){
            //     $error_message = array('program_reference' => array('Program does not exist'));
            //     return response()->json([
            //         'message' => 'The given data was invalid',
            //         'errors' => $error_message
            //     ], 422);
            // }

            //return response()->json(['message' => 'success', 'record'=>$program]);

            return view('web.program-management.edit-program', compact('program'));

        }

        catch (ModelNotFoundException $e){

            return response()->json([
                'message' => 'Program not found'
            ], 404);

        }
        
    }



    public function updateProgram(EditProgramRequest $request){

        // $user = Auth::user();

        // if( $user->can('update-program')){

        //     return abort('403'); 
        // }
       
        $validated =  $request->validated();

        //info($validated);

        try{

            \DB::beginTransaction();

            $program = Program::where('program_reference', $validated['program_reference'])->first();  
            
            if($program === null ){
                $error_message = array('program_reference' => array('Program does not exist'));
                return response()->json([
                    'message' => 'The given data was invalid',
                    'errors' => $error_message
                ], 422);
            }

            $program->where('program_reference', $validated['program_reference'])->update($validated);

            \DB::commit();

            return response()->json(['message' => 'Program updated successfully']);

        }
        catch(\Exception $e){
       
            \DB::rollBack();

            info($e);

            return response()->json(['message' => 'Error updating Program'], 500);
        }
    
    }



    public function deleteProgram($id){

        // if( !Auth::user()->can('delete-program')){

        //     return abort('403'); 
        // }

        try{

            $program = Program::where('program_reference', $id)->first();
            $program->delete();

            return response()->json(['message' => 'Program deleted successfully.']);

        }

        catch (ModelNotFoundException $e){

            Log::$e;

            return response()->json([
                'message' => 'Program not found'
            ], 404);

        }


    }
    

}
