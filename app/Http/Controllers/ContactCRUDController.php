<?php
 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Models\Contact; 
use Datatables;
 
class ContactCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Contact::select('*'))
            ->addColumn('action', 'contact-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('contacts');
    }
      
      
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {  
 
        $contactId = $request->id;
 
        $contact = Contact::updateOrCreate(
            ['id' => $contactId],
            [
            'name' => $request->name, 
            'phone' => $request->phone,
            ]
        );    
                         
        return Response()->json($contact);
    }
      
      
    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $contact  = Contact::where($where)->first();
      
        return Response()->json($contact);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $contact = Contact::where('id',$request->id)->delete();
      
        return Response()->json($contact);
    }
}