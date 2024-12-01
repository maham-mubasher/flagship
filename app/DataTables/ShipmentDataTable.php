<?php

namespace App\DataTables;

use App\Models\Shipment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ShipmentDataTable extends DataTable
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
            ->addColumn('information', function (Shipment $model) {

                return '';
            })
            ->addColumn('action', function (Shipment $model) {
                return view('pages.shipments.partials._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Shipment  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipment $model)
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
            ->setTableId('pickups-table')
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
            Column::make('shipment_date')->title('Shipment Date')->addClass('ps-0'),
            Column::make('signature_required')->title('Signature')->addClass('ps-0'),
            Column::make('payment_payer')->title('Payment Payer')->addClass('ps-0'),
            Column::make('payment_account_number')->title("Account"),
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
        return 'Shipment_' . date('YmdHis');
    }
}
