<?php

namespace App\DataTables\ImportQuotes;

use App\Models\Address;
use App\Models\AddressGroup;
use App\Models\Country;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AddressBookDataTable extends DataTable
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
            ->setRowData([
                'data-address' => function (Address $model) { return $model; },
            ])
            ->setRowClass('cursor-pointer');
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
            ->minifiedAjax('', null, ['address_group_id' => '$("#address_group_id").val()'])
            ->stateSave()
            ->orderBy(0)
            ->responsive()
            ->autoWidth(false)
            ->parameters([
                'scrollX'      => true,
                'drawCallback' => 'function() { KTMenu.createInstances(); }',
                'buttons'      => [/*'export', 'print', 'reset', 'reload'*/],
                'rowCallback' => 'function(row, data, index) {

                    $(row).attr("data-address", JSON.stringify(data["DT_RowData"]["data-address"]));
                    $(row).attr("data-row-index", data.id);

                    // Add click event listener to the row
                    $(row).on("click", function() {
                        // Retrieve the address object
                        var address = $(this).data("address");

                        const prefix = $("#prefix_input").val();
                        $(`#${prefix}_address`).val(address.address);
                        $(`#${prefix}_city`).val(address.city);
                        $(`#${prefix}_suite`).val(address.suite);
                        $(`#${prefix}_postal_code`).val(address.postal_code);
                        $(`#${prefix}_country`).val(address.country_id).trigger("change");

                        $("#addressbook_modal").modal("hide");
                    });
                }'
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
            Column::make('checkbox')
                ->title('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false)
                ->width('10px')
                ->checkbox(),
            Column::make('company_name')->title('Company')->addClass('ps-0'),
            Column::make('attention')->title('Attention'),
            Column::make('address')->title("Address"),
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
