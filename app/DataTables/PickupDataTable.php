<?php

namespace App\DataTables;

use App\Models\Pickup;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PickupDataTable extends DataTable
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
            ->addColumn('information', function (Pickup $model) {

                return '';
            })
            ->addColumn('action', function (Pickup $model) {
                return view('pages.pickups.partials._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Pickup  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pickup $model)
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
            Column::make('courier_name')->title('Courier')->addClass('ps-0'),
            Column::make('confirmation_number')->title('Confirmation Number')->addClass('ps-0'),
            Column::make('pickup_date')->title('Pickup Date')->addClass('ps-0'),
            Column::make('package_count')->title("Total Pickups"),
            Column::make('weight')->title('Total Weight')->addClass('ps-0'),
            Column::make('is_ground')->title('# of Shipments')->addClass('ps-0'),
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
        return 'DataPickups_'.date('YmdHis');
    }
}
