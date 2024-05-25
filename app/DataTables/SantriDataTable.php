<?php

namespace App\DataTables;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SantriDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($data) {
                return (
                    '<button class="btn btn-action btn-primary mr-1 btn-edit" id="'.$data->id.'"><i class="far fa-edit"></i></button>'.
                    '<button class="btn btn-action btn-danger mr-1 btn-delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>'.
                    '<button class="btn btn-action btn-info" id="'.$data->id.'"><i class="fas fa-info-circle"></i></button>'
                );
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Santri $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('santri-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                    ->title('No.')
                    ->addClass('text-center'),
            Column::make('nis'),
            Column::make('name'),
            Column::make('gender'),
            Column::make('birth_day'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(140)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Santri_' . date('YmdHis');
    }
}
