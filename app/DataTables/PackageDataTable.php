<?php

namespace App\DataTables;

use App\Models\Package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PackageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query->where('user_id', auth()->id());
        return datatables()
            ->eloquent($query)
            ->rawColumns([ 'action'])
            ->addColumn('information', function (Package $model) {

                return '';
            })
            ->addColumn('action', function (Package $model) {
                return view('pages.packages.partials._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Package  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('packages-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(0)
            ->responsive()
            ->autoWidth(false)
            ->parameters([
                'scrollX'      => true,
                'drawCallback' => 'function() { KTMenu.createInstances(); }',
                'buttons'      => [/*'export', 'print', 'reset', 'reload'*/],
            ])
            ->addTableClass('align-middle table table-rounded table-striped table-hover table-row-bordered gy-3 gs-7 fs-6');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')->title('Package Name')->addClass('ps-0'),
            Column::make('type')->title('Type')->addClass('ps-0'),
            Column::make('package_count')->title("Total Packages"),
            Column::make('information')->title("Package Information<br /> L x W x H - Weight - Description"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'DataPackages_'.date('YmdHis');
    }
}
