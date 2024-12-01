<?php

namespace App\DataTables\Addresses;

use App\Models\AddressGroup;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AddressGroupDataTable extends DataTable
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
        return datatables()
            ->eloquent($query)
            ->rawColumns([ 'action'])
            ->addColumn('no_of_addresses', function (AddressGroup $addressGroup) {
                return $addressGroup->addresses()->count();
            })
            ->addColumn('action', function (AddressGroup $model) {
                return view('pages.address-groups.partials._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  AddressGroup  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AddressGroup $model)
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
            ->setTableId('address-group-table')
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
            Column::make('name')->title('Group Name')->addClass('ps-0'),
            Column::make('no_of_addresses')->title("Number of Addresses"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-end')
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
        return 'DataAddressGroups_'.date('YmdHis');
    }
}
