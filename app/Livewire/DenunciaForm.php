<?php

namespace App\Livewire;

use App\Http\Requests\DenunciaRequest;
use App\Models\Denuncia;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class DenunciaForm extends Component
{
    use WithFileUploads;

    public ?Denuncia $denuncia = null;

    public $formTitulo = '';
    public $formDescripcion = '';
    public $formUbicacion = '';
    public $formEstado = 'pendiente';
    public $formCiudadano = '';
    public $formTelefonoCiudadano = '';
    public $formFechaRegistro;
    public $formImagen;
    public $formExistingImage;

    public function mount(Denuncia $denuncia = null): void
    {
        $this->denuncia = $denuncia;

        if ($denuncia) {
            $this->formTitulo = $denuncia->titulo;
            $this->formDescripcion = $denuncia->descripcion;
            $this->formUbicacion = $denuncia->ubicacion;
            $this->formEstado = $denuncia->estado;
            $this->formCiudadano = $denuncia->ciudadano;
            $this->formTelefonoCiudadano = $denuncia->telefono_ciudadano;
            $this->formFechaRegistro = optional($denuncia->fecha_registro)->format('Y-m-d\\TH:i');
            $this->formExistingImage = $denuncia->imagen;
        } else {
            $this->formFechaRegistro = now()->format('Y-m-d\\TH:i');
        }
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function submit()
    {
        $data = $this->validate();

        $payload = [
            'titulo' => $data['formTitulo'],
            'descripcion' => $data['formDescripcion'],
            'ubicacion' => $data['formUbicacion'],
            'estado' => $data['formEstado'],
            'ciudadano' => $data['formCiudadano'],
            'telefono_ciudadano' => $data['formTelefonoCiudadano'],
            'fecha_registro' => $data['formFechaRegistro']
                ? Carbon::parse($data['formFechaRegistro'])
                : null,
        ];

        if ($this->formImagen instanceof TemporaryUploadedFile) {
            $payload['imagen'] = 'storage/' . $this->formImagen->store('denuncias', 'public');
        } elseif ($this->formExistingImage) {
            $payload['imagen'] = $this->formExistingImage;
        }

        if ($this->denuncia) {
            $this->denuncia->update($payload);
            $message = 'Denuncia actualizada correctamente.';
        } else {
            Denuncia::create($payload);
            $message = 'Denuncia registrada correctamente.';
        }

        session()->flash('success', $message);
        $this->dispatch('layout-confirm', [
            'type' => 'success',
            'message' => $message,
        ]);

        return redirect()->route('denuncias.index');
    }

    public function render()
    {
        return view('livewire.denuncia-form', [
            'estados' => $this->availableStatuses(),
            'mode' => $this->denuncia ? 'edit' : 'create',
        ]);
    }

    protected function rules(): array
    {
        $baseRules = (new DenunciaRequest())->rules();

        $baseRules['imagen'] = $this->denuncia
            ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            : $baseRules['imagen'];

        return [
            'formTitulo' => $baseRules['titulo'],
            'formDescripcion' => $baseRules['descripcion'],
            'formUbicacion' => $baseRules['ubicacion'],
            'formEstado' => $baseRules['estado'],
            'formCiudadano' => $baseRules['ciudadano'],
            'formTelefonoCiudadano' => $baseRules['telefono_ciudadano'],
            'formFechaRegistro' => $baseRules['fecha_registro'],
            'formImagen' => $baseRules['imagen'],
        ];
    }

    protected function availableStatuses(): array
    {
        return [
            'pendiente' => 'Pendiente',
            'en proceso' => 'En proceso',
            'resuelto' => 'Resuelto',
        ];
    }
}
