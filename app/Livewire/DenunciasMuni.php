<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Denuncia;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Builder;


class DenunciasMuni extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $text = '';
    public $estado = '';
    public $ciudadano = '';
    public $ubicacion = '';
    public $telefono = '';
    public $desde;
    public $hasta;
    public $perPage = 10;
    public $sortField = 'fecha_registro';
    public $sortDirection = 'desc';

    protected $queryString = [
        'text' => ['except' => ''],
        'estado' => ['except' => ''],
        'ciudadano' => ['except' => ''],
        'ubicacion' => ['except' => ''],
        'telefono' => ['except' => ''],
        'desde' => ['except' => ''],
        'hasta' => ['except' => ''],
        'sortField' => ['except' => 'fecha_registro'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function updating($property): void
    {
        if ($property !== 'perPage') {
            $this->resetPage();
        }
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    public function render()
    {
                $denuncias = Denuncia::query()
            ->when($this->text, function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query->where('titulo', 'like', "%{$this->text}%")
                        ->orWhere('descripcion', 'like', "%{$this->text}%")
                        ->orWhere('ciudadano', 'like', "%{$this->text}%")
                        ->orWhere('ubicacion', 'like', "%{$this->text}%");
                });
            })
            ->when($this->estado, fn (Builder $query) => $query->where('estado', $this->estado))
            ->when($this->ciudadano, fn (Builder $query) => $query->where('ciudadano', 'like', "%{$this->ciudadano}%"))
            ->when($this->ubicacion, fn (Builder $query) => $query->where('ubicacion', 'like', "%{$this->ubicacion}%"))
            ->when($this->telefono, fn (Builder $query) => $query->where('telefono_ciudadano', 'like', "%{$this->telefono}%"))
            ->when($this->desde, fn (Builder $query) => $query->whereDate('fecha_registro', '>=', $this->desde))
            ->when($this->hasta, fn (Builder $query) => $query->whereDate('fecha_registro', '<=', $this->hasta))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate((int) $this->perPage);

        return view('livewire.denuncias-muni', [
            'denuncias' => $denuncias,
            'estados' => [
                'pendiente' => 'Pendiente',
                'en proceso' => 'En proceso',
                'resuelto' => 'Resuelto',
            ],
        ]);
    }
}
