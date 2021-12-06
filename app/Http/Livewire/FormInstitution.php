<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Branch;
use App\Models\Coordinator;
use App\Models\Department;
use App\Models\Institution;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Util;

class FormInstitution extends Component
{
    use WithFileUploads;    
    use WithPagination;

    protected $listeners = ['concluirRegistro', 'concluirRegistroVacancias'];    

    public $institution;
    public $institution_id;
    //complementar datos
    public $archivoNit;
    public $rubro;
    public $nit;
    public $razon_social;
    public $actividad;
    public $file_nit;
    //representante
    public $nombreRepresentante;
    public $paternoRepresentante;
    public $maternoRepresentante;
    public $emailRepresentante;
    public $telefonoRepresentante;
    //sucursales
    public $tipo;
    public $departamento;
    public $direccion;
    public $telefono;
    //enlaces
    public $nombresEnlace;
    public $paternoEnlace;
    public $maternoEnlace;
    public $telefonoEnlace;
    public $correoEnlace;

    //eventos
    public $showDivSucursal = false;
    public $showDivContacto = false;
    public $showFileNit = false;
    public $estadoAction = false;
    public $dialogBranch;

    //Extras
    public $urlfileView;
    public $dialog;    

    public function mount()
    {        
        $this->rubro = $this->institution->rubro;
        $this->actividad = $this->institution->actividad;
        $this->nit = $this->institution->nit;
        $this->razon_social = $this->institution->razon_social;
        $this->file_nit = $this->institution->file_nit;
        
        $this->showFileNit = $this->file_nit == null ? false : true;
        $this->dialogBranch =false;

        $this->nombreRepresentante = $this->institution->nombre;
        $this->paternoRepresentante = $this->institution->paterno;
        $this->maternoRepresentante = $this->institution->materno;
        $this->emailRepresentante = $this->institution->email;
        $this->telefonoRepresentante = $this->institution->telefono;

        $this->estadoAction = $this->institution->estado == 'PENDIENTE' ? 'block' : 'none';

        $this->urlfileView='/';
        $this->dialog = false;        
    }

    public function render()
    {   
        $departments = Department::all();
        $branchs = Branch::where('institution_id', $this->institution_id)->paginate(10);
        $coordinators = Coordinator::where('institution_id', $this->institution_id)->paginate(10);

        return view('livewire.form-institution', compact('departments', 'branchs', 'coordinators'));
    }

    public function updateInstitution(){        

        if($this->file_nit==null){
            $rules = [
                'rubro' => 'required',
                'nit' => 'required|unique:institutions,nit,'.$this->institution_id,                
                'actividad' => 'required',
                'archivoNit' => 'required|mimes:jpg,bmp,png,pdf|max:5120'
            ];
        }else{
            $rules = [
                'rubro' => 'required',
                'actividad' => 'required',
                'nit' => 'required|unique:institutions,nit,'.$this->institution_id,                   
            ];
        }
        
        $this->validate($rules,[
            'rubro.required' => 'El campo Gran Actividad es obligatorio!',
            'actividad.required' => 'El campo Actividad Principal es obligatorio!',
            'archivoNit.required' => 'El archivo digital de su NIT es obligatorio!',            
        ]);
        

        $nitRazonSocial =  Util::apiGetNitRazonSocial($this->nit);                
        try {
            $institution = Institution::find($this->institution_id);
            $institution->rubro = mb_strtoupper($this->rubro);
            $institution->actividad = mb_strtoupper($this->actividad);
            $nitRazonSocial = ($nitRazonSocial!=null OR $nitRazonSocial!=false)?$nitRazonSocial:'FALSE';
            $institution->razon_social = mb_strtoupper($nitRazonSocial);
            $this->razon_social = $nitRazonSocial;
            $institution->nit = $this->nit;

            if($this->archivoNit!=null)
            $institution->file_nit = str_replace("public/", "storage/", $this->archivoNit->store('public'));

            $institution->save();

            $this->showFileNit = true;
            $this->file_nit = $institution->file_nit;
            
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',  
                'message' => 'Los datos se guardaron correctamente.!'
            ]);

        } catch (\Exception $e) {                  
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',  
                'message' => 'Error al guardar los datos, intente nuevamente.'
            ]);
        }

        // session()->flash('message', 'Los datos se guardaron correctamente.');
       
    }

    public function updateLegalRepresentative(){
        $this->validate([
            'nombreRepresentante' => 'required',
            'paternoRepresentante' => 'required',
            'maternoRepresentante' => 'required',
            'telefonoRepresentante' => 'required|numeric',
            'emailRepresentante' => 'required|email'
        ]);
        try {
            $institution = Institution::find($this->institution_id);
            $institution->nombre = mb_strtoupper($this->nombreRepresentante);
            $institution->paterno = mb_strtoupper($this->paternoRepresentante);
            $institution->materno = mb_strtoupper($this->maternoRepresentante);
            $institution->telefono = mb_strtoupper($this->telefonoRepresentante);
            $institution->email = $this->emailRepresentante;
            $institution->save();
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Los datos se guardaron correctamente.!']);
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',  
                'message' => 'Error al guardar los datos, intente nuevamente.'
            ]);
        }
        // session()->flash('message', 'Los datos se guardaron correctamente.');
        
    }

    public function addBranch(){
        $this->validate([
            'tipo' => 'required',
            'departamento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric'
        ]);

        try {
            $branch = new Branch();
            $branch->institution_id = $this->institution_id;
            $branch->department_id = $this->departamento;
            $branch->direccion = mb_strtoupper($this->direccion);
            $branch->telefono = $this->telefono;
            $branch->tipo = $this->tipo;
            $branch->estado = "ACTIVO";
            $branch->save();
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Los datos se guardaron correctamente.!']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',  
                'message' => 'Error al guardar los datos, intente nuevamente.'
            ]);
        }
        // session()->flash('message', 'Los datos se guardaron correctamente.');
        
        

        $this->defaultBranch();
    }

    public function defaultBranch()
    {
        $this->departamento = "";
        $this->direccion = "";
        $this->telefono = "";
        $this->showDivSucursal = false;
    }

    public function deleteBranch($id)
    {
        $branch = Branch::find($id);
        if($branch){
            $branch->delete();
            // session()->flash('message', 'Se elimino el registro correctamente.');
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Se elimino el registro correctamente.!']);
        }
    }

    public function addCoordinator()
    {
        $this->validate([
            'nombresEnlace' => 'required',
            'paternoEnlace' => 'required',
            'maternoEnlace' => 'required',
            'telefonoEnlace' => 'required|numeric',
            'correoEnlace' => 'required|email'
        ]);

        try {
            $coordinator = new Coordinator();
            $coordinator->institution_id = $this->institution_id;
            $coordinator->nombres = mb_strtoupper($this->nombresEnlace);
            $coordinator->paterno = mb_strtoupper($this->paternoEnlace);
            $coordinator->materno = mb_strtoupper($this->maternoEnlace);
            $coordinator->telefono = $this->telefonoEnlace;        
            $coordinator->email = $this->correoEnlace;
            $coordinator->estado = "ACTIVO";
            $coordinator->save();
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Los datos se guardaron correctamente.!']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',  
                'message' => 'Error al guardar los datos, intente nuevamente.'
            ]);
        }
        // session()->flash('message', 'Los datos se guardaron correctamente.');
        

        $this->defaultCoordinator();
    }

    public function defaultCoordinator()
    {
        $this->nombresEnlace = "";
        $this->paternoEnlace = "";
        $this->maternoEnlace = "";
        $this->telefonoEnlace = "";
        $this->correoEnlace = "";
        $this->showDivContacto = false;
    }
    public function deleteCoordinator($id)
    {
        $coordinator = Coordinator::find($id);
        if($coordinator){
            $coordinator->delete();
            // session()->flash('message', 'Se elimino el registro correctamente.');
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Se elimino el registro correctamente!']);
        }
    }

    public function eliminarArchivoNit(){

        

        $institution = Institution::find($this->institution_id);     
        
        $file = 'storage/' . $institution->file_nit;
        File::delete($file);

        $institution->file_nit = null;
        $institution->save();                        

        $this->showFileNit = false;
        $this->archivoNit = null;
        $this->file_nit = null;
        
        
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Se elimino el archivo correctamente!']);
    }

    public function alertConclucion()
    {        
        //Validamos el Nit
        $institution = Institution::find($this->institution_id);
        $nitValidate =  Util::apiGetNit($institution->nit);
        try{
            if($nitValidate==false){
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',  
                    'message' => 'El NIT ingresado es invalido.'
                ]);
                return false;
            }
        }catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',  
                'message' => 'No pudimos validar el Nit Registrato. Intente nuevamente.'
            ]);
        }

        if(empty( Branch::where('institution_id', $this->institution_id)->count()) ){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',  
                'message' => 'Complete toda la información solicitada.'
            ]);
            return false;
         }

         if(empty( Coordinator::where('institution_id', $this->institution_id)->count()) ){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',  
                'message' => 'Complete toda la información solicitada.'
            ]);
            return false;
         }

       $this->dispatchBrowserEvent('swal:confirmEntidad', [
            'type' => 'warning',  
            'message' => 'Concluir registro?', 
            'text' => 'Antes de concluir, debe estar seguro que registró toda la información solicitada.'
        ]);
        
    }


    public function alertConclucionVacancias()
    {
       $this->dispatchBrowserEvent('swal:confirmEntidadvacancias', [
            'type' => 'warning',  
            'message' => 'Concluir registro y activar registro de Vacancias?', 
            'text' => '1. Verifique que ingreso la información solicitada 2. El sistema activara el registro de Vacancias en esta cuenta.'
        ]);
        
    }

    public function concluirRegistro()
    {   
        $institution = Institution::find($this->institution_id);   
        $institution->estado = "REGISTRADO";
        $institution->save();
        return redirect()->to('/institution/dashboard');
    }

    public function concluirRegistroVacancias()
    {   
        $institution = Institution::find($this->institution_id);   
        $institution->estado = "ACTIVO";
        $institution->save();
        return redirect()->to('/institution/dashboard');
    }

    public function showDialogBrach()
    {        
        $this->dialogBranch = true;
    }
    public function closeDialogBrach()
    {
        $this->dialogBranch=false;
    }


    public function setArchivo()
    {
        //$institution = Institution::find($id);
        if($this->file_nit !="")
        {                       
            $this->urlfileView = $this->file_nit;
            // $this->urlfile = $decendant->certificado;
            $this->dialog =true;
        }
        
    }

    public function closeModal()
    {
        $this->dialog=false;
    }

}
