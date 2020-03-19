<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Paciente;
use App\Estado;
use App\Atencion;
use App\Procedimiento;
use Carbon\Carbon;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        //
        $pacientes = Paciente::join('estado_paciente', 'pacientes.id_estado', '=', 'estado_paciente.id')
        ->select('pacientes.id', 'pacientes.id_estado', 'pacientes.nombre','pacientes.fec_nacimiento','pacientes.telefono', 'pacientes.direccion','pacientes.email','pacientes.cedula','pacientes.id_estado','estado_paciente.id as id_paciente_estado','estado_paciente.descripcion')
        ->orderby('pacientes.nombre','asc')->paginate(12);

        return view('contenido.pacientes',compact('pacientes'))
            ->with('i', (request()->input('page', 1) - 1) * 12);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $identificacion =  $request->input("busc_id");
        $nombre = $request->input("busc_nombre");
        $estado = $request->input("busc_estado");

        if($identificacion <> '' || $nombre <> '' || $estado >= 1)
        {

        }
        else{
        $data = request()->validate([
            'nombre' => 'required',
            'fec_nacimiento' => 'nullable|date',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
            'email' => 'nullable|email|unique:pacientes',
            'cedula' => 'required|unique:pacientes',
            'id_estado' => 'required',
        ]);

        if($data){

            $check = Paciente::create([
                'nombre' => $request->input('nombre'),
                'fec_nacimiento' => Carbon::createFromFormat( 'd/m/Y', $request->input('fec_nacimiento')),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'email' => $request->input('email'),
                'cedula' => $request->input('cedula'),
                'id_estado' => $request->input('id_estado')
            ]);
            $mensaje = 1;

            //return back()->withInput()->with(compact('mensaje'));
            return redirect()->route('pacientes.index')->with( ['mensaje' => $mensaje] );

        }
        else{

            $mensaje = "No se pudo crear nada";
            return back()->withInput();

        }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pacientes_show = Paciente::find($id);
        $estado = Estado::find($pacientes_show->id_estado);
        //$atenciones = Atencion::all();
        $atenciones = Atencion::where('id_pacientes', $id)
               ->orderBy('fec_inicio', 'desc')
               ->take(4)
               ->get();

        return view('contenido.pacientes.pacientes_show',compact('pacientes_show','estado', 'atenciones'));

        //return back()->withInput();
        //return redirect()->back()->with(compact('pacientes_show'));
        //return $pacientes_show ;
        //
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
        $pacientes_edit = Paciente::find($id);
        $estado = Estado::find($pacientes_edit->id_estado);
        return view('contenido.pacientes.pacientes_edit',compact('pacientes_edit','estado'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
