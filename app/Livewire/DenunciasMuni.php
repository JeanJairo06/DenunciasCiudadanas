<?php

namespace App\Livewire;

use App\Models\Denuncia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class DenunciasMuni extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $filterText = '';
    public $filterEstado = '';
    public $filterCiudadano = '';
    public $filterUbicacion = '';
    public $filterTelefono = '';
    public $filterDesde;
    public $filterHasta;

    public $perPage = 10;
    public $sortField = 'fecha_registro';
    public $sortDirection = 'desc';

    public $showDeleteModal = false;
    public $deleteDenunciaId;
    public $deleteDenunciaTitle;

    protected $queryString = [
        'filterText' => ['except' => ''],
        'filterEstado' => ['except' => ''],
        'filterCiudadano' => ['except' => ''],
        'filterUbicacion' => ['except' => ''],
        'filterTelefono' => ['except' => ''],
        'filterDesde' => ['except' => ''],
        'filterHasta' => ['except' => ''],
        'sortField' => ['except' => 'fecha_registro'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function updating($property): void
    {
        if ($property === 'perPage') {
            return;
        }

        $this->resetPage();
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

    public function clearFilters(): void
    {
        $this->reset([
            'filterText',
            'filterEstado',
            'filterCiudadano',
            'filterUbicacion',
            'filterTelefono',
            'filterDesde',
            'filterHasta',
        ]);

        $this->resetPage();
    }

    public function render()
    {
        if (! Schema::hasTable('denuncias')) {
            $denuncias = new LengthAwarePaginator(
                [],
                0,
                (int) $this->perPage,
                $this->page ?? 1,
                [
                    'path' => Paginator::resolveCurrentPath(),
                ]
            );
        } else {
            $denuncias = Denuncia::query()
                ->when($this->filterText, function (Builder $query) {
                    $query->where(function (Builder $query) {
                        $query->where('titulo', 'like', "%{$this->filterText}%")
                            ->orWhere('descripcion', 'like', "%{$this->filterText}%")
                            ->orWhere('ciudadano', 'like', "%{$this->filterText}%")
                            ->orWhere('ubicacion', 'like', "%{$this->filterText}%");
                    });
                })
                ->when($this->filterEstado, fn(Builder $query) => $query->where('estado', $this->filterEstado))
                ->when($this->filterCiudadano, fn(Builder $query) => $query->where('ciudadano', 'like', "%{$this->filterCiudadano}%"))
                ->when($this->filterUbicacion, fn(Builder $query) => $query->where('ubicacion', 'like', "%{$this->filterUbicacion}%"))
                ->when($this->filterTelefono, fn(Builder $query) => $query->where('telefono_ciudadano', 'like', "%{$this->filterTelefono}%"))
                ->when($this->filterDesde, fn(Builder $query) => $query->whereDate('fecha_registro', '>=', $this->filterDesde))
                ->when($this->filterHasta, fn(Builder $query) => $query->whereDate('fecha_registro', '<=', $this->filterHasta))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate((int) $this->perPage);
        }

        return view('livewire.denuncias-muni', [
            'denuncias' => $denuncias,
            'estados' => $this->availableStatuses(),
        ]);
    }

    public function confirmDelete(int $id): void
    {
        $denuncia = Denuncia::find($id);

        if (! $denuncia) {
            return;
        }

        $this->deleteDenunciaId = $id;
        $this->deleteDenunciaTitle = $denuncia->titulo;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deleteDenunciaId = null;
        $this->deleteDenunciaTitle = null;
    }

    public function deleteDenuncia(): void
    {
        $denuncia = Denuncia::find($this->deleteDenunciaId);

        if (! $denuncia) {
            $this->dispatchFeedback('error', 'No se pudo eliminar la denuncia seleccionada.');
            $this->closeDeleteModal();
            return;
        }

        $denuncia->delete();

        $this->dispatchFeedback('success', 'Denuncia eliminada correctamente.');
        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function changeEstadoQuick(int $denunciaId, string $estado): void
    {
        if (! array_key_exists($estado, $this->availableStatuses())) {
            $this->dispatchFeedback('error', 'El estado seleccionado no es válido.');
            return;
        }

        $denuncia = Denuncia::find($denunciaId);

        if (! $denuncia) {
            $this->dispatchFeedback('error', 'No se pudo encontrar la denuncia.');
            return;
        }

        $denuncia->update(['estado' => $estado]);

        $this->dispatchFeedback('success', 'Estado actualizado correctamente.');
    }

    protected function availableStatuses(): array
    {
        return [
            'pendiente' => 'Pendiente',
            'en proceso' => 'En proceso',
            'resuelto' => 'Resuelto',
        ];
    }

    protected function dispatchFeedback(string $type, string $message): void
    {
        session()->flash($type === 'error' ? 'error' : 'success', $message);
        $this->dispatch('layout-confirm', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
