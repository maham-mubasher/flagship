<?php

namespace App\DataTables\Addresses;

use App\Models\Address;
use App\Models\AddressGroup;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AddressDataTable extends DataTable
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
            ->eloquent($query->where('address_group_id', $this->address_group_id))
            ->rawColumns([ 'action'])
            ->addColumn('information', function (Address $model) {
                return "";
            })
            ->addColumn('action', function (Address $model) {
                return view('pages.address-groups.addresses.partials._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Address  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Address $model)
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
            ->setTableId('addresses-table')
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
            Column::make('company_name')->title('Company')->addClass('ps-0'),
            Column::make('attention')->title('Attention'),
            Column::make('address')->title("Address"),
            Column::make('information')->title("Phone/Email"),
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
        return 'DataAddresss_'.date('YmdHis');
    }
}
