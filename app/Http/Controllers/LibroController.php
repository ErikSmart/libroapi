<?php

namespace App\Http\Controllers;
  // use Illuminate\http\Request;
use App\Libro;
  // use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LibroController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index()
   {
     $libros = Libro::all();

    return $this->successResponse($libros);

   }
   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //
   }
   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
     $reglas = [
       'titulo' => 'required|max:30',
       'descripcion' => 'required|max:255',
       'precio' => 'required|min:1',
       'autor_id' => 'required|min:1'
     ];

     $this->validate($request, $reglas);
     $libros = Libro::create($request->all());
     return $this->successResponse($libros, Response::HTTP_CREATED);

   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
     $libro = Libro::findOrFail($id);

     return $this->successResponse($libro);
   }
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       //
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
     $reglas = [
       "titulo" => "max:50",
       "descripcion" => "max:255",
       "precio" => "min:1",
       "autor_id" => "min:1"
     ];
     $id = Libro::findOrFail($id);
     $id->fill($request->all());
     if ($id->isClean()) {
       $this->errorResponse("debe haber algo",Response::HTTP_UNPROCESSABLE_ENTITY);
     }
     $id->save();
     return $this->successResponse($id);
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
     $id = Libro::findOrFail($id);

     $id->delete($id);
     
     return $this->successResponse($id);
   }
}
