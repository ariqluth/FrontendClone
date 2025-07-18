<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // report data
        $salesreport = DB::table('sales_penjualan')
                     ->select('sales_penjualan.company', 'sales_penjualan.sales_order','sales_penjualan.po_number', 'sales_penjualan.so_date', 'sales_penjualan.invoice', 'sales_penjualan.external_invoice', 'sales_penjualan.invoice_date', 'sales_penjualan.due_date', 'sales_penjualan.name', 'sales_penjualan.address_group', 'sales_penjualan.packslip_date', 'sales_penjualan.packing_slip', 'sales_penjualan.external_packing_slip', 'sales_penjualan.sales')
                     ->get();
        $customerreport = DB::table('customer_penjualan')
                     ->select('division_penjualan.divisi','customer_penjualan.invoicing_name_custom', 'customer_penjualan.group_city','customer_penjualan.group_county', 'customer_penjualan.group_state', 'customer_penjualan.pkp', 'customer_penjualan.npwp', 'customer_penjualan.nama', 'customer_penjualan.alamat')
                     ->join('division_penjualan', 'customer_penjualan.division_id', '=', 'division_penjualan.id')
                     ->get();
        $itemreport = DB::table('item_penjualan')
                     ->select('sales_penjualan.sales_order','item_penjualan.item_number', 'item_penjualan.item_name_origin','item_penjualan.item_name', 'item_penjualan.group_product', 'item_penjualan.dimensi_gelombang', 'item_penjualan.thickness', 'item_penjualan.length', 'item_penjualan.length_m', 'item_penjualan.color_type', 'item_penjualan.size_width', 'item_penjualan.qty', 'item_penjualan.unit', 'item_penjualan.qty_in_kg_ppic', 'item_penjualan.qty_in_kg_mkt')
                     ->join('sales_penjualan', 'item_penjualan.sales_order_id', '=', 'sales_penjualan.id')
                     ->get();
        $divisionreport = DB::table('division_penjualan')
                     ->select('item_penjualan.item_number','division_penjualan.divisi', 'division_penjualan.credit_limit','division_penjualan.cl_group')
                     ->join('item_penjualan', 'division_penjualan.item_id', '=', 'item_penjualan.id')
                     ->get();
        $pricereport = DB::table('price_penjualan')
                     ->select('item_penjualan.item_number','price_penjualan.price', 'price_penjualan.disc_percent','price_penjualan.disc_value', 'price_penjualan.line_discount', 'price_penjualan.header_disc', 'price_penjualan.total', 'price_penjualan.tax_code', 'price_penjualan.tax', 'price_penjualan.total_and_tax', 'price_penjualan.include_tax')
                     ->join('item_penjualan', 'price_penjualan.item_id', '=', 'item_penjualan.id')
                     ->get();
        $shipperreport = DB::table('shipper_penjualan')
                     ->select('item_penjualan.item_number', 'division_penjualan.divisi','shipper_penjualan.kota', 'shipper_penjualan.propinsi','shipper_penjualan.sales_district_id','shipper_penjualan.district','shipper_penjualan.term','shipper_penjualan.pay_status','shipper_penjualan.closed_date','shipper_penjualan.note_1','shipper_penjualan.note_2','shipper_penjualan.note_3' )
                     ->join('item_penjualan', 'shipper_penjualan.item_id', '=', 'item_penjualan.id')
                     ->join('division_penjualan', 'shipper_penjualan.division_id', '=', 'division_penjualan.id')
                     ->get();
        $countreport = DB::table('sales_penjualan')
                    ->select('item_penjualan.item_number', 'price_penjualan.price')
                    ->join('item_penjualan', 'item_penjualan.sales_order_id', '=', 'sales_penjualan.id')
                    ->join('price_penjualan', 'price_penjualan.item_id', '=', 'item_penjualan.id')
                    ->count();
        //  invoice data
        $priceinvoice = DB::table('price_invoice')
                     ->select('shipper_invoice.delivery_name', 'price_invoice.discount_percent', 'price_invoice.total_discount_percent', 'price_invoice.amount', 'price_invoice.tax_amount', 'price_invoice.prices_include_sales_tax', 'price_invoice.amount_exc_tax', 'price_invoice.amount_inc_tax', 'price_invoice.value', 'price_invoice.div')
                     ->join('shipper_invoice', 'price_invoice.shipper_invoice_id', '=', 'shipper_invoice.id')
                     ->get();
        $shipperinvoice = DB::table('shipper_invoice')
                     ->select('sales_invoice.sales_order','shipper_invoice.delivery_name', 'shipper_invoice.currency', 'shipper_invoice.payment', 'shipper_invoice.packing_slip', 'shipper_invoice.external_packing_slid', 'shipper_invoice.date', 'shipper_invoice.delivery_name', 'shipper_invoice.note', 'shipper_invoice.item_number', 'shipper_invoice.product_name', 'shipper_invoice.delivered', 'shipper_invoice.unit', 'shipper_invoice.delivered_2', 'shipper_invoice.unit_2', 'shipper_invoice.unit_price')
                     ->join('sales_invoice', 'shipper_invoice.sales_invoice_id', '=', 'sales_invoice.id')
                     ->get();
        $salesinvoice = DB::table('sales_invoice')
                     ->select('sales_invoice.invoice_account', 'sales_invoice.description', 'sales_invoice.customer_address_group', 'sales_invoice.customer_credit_limit_group', 'sales_invoice.sales_order', 'sales_invoice.sales_responsible')
                     ->get();
        $countinvoice = DB::table('price_invoice')
                     ->select('price_invoice.total', 'shipper_invoice.price')
                     ->join('shipper_invoice', 'price_invoice.shipper_invoice_id', '=', 'shipper_invoice.id')
                     ->count();
        // request data
        $pricerequest = DB::table('price_request')
                     ->select('product_request.product_name', 'price_request.unit_price', 'price_request.discount_percent', 'price_request.deliver_remainder', 'price_request.remain_qty_2', 'price_request.sales_tax_group', 'price_request.item_sales_tax_group', 'price_request.value', 'price_request.value_inc_tax', 'price_request.dimension_value')
                     ->join('product_request', 'price_request.product_request_id', '=', 'product_request.id')
                     ->get();
        $productrequest = DB::table('product_request')
                     ->select('sales_request.sales_order', 'product_request.item_number', 'product_request.product_name', 'product_request.currency', 'product_request.unit', 'product_request.quantity')
                     ->join('sales_request', 'product_request.sales_request_id', '=', 'sales_request.id')
                     ->get();
        $salesrequest = DB::table('sales_request')
                     ->select('sales_request.flag', 'sales_request.sales_order', 'sales_request.customer', 'sales_request.name', 'sales_request.customer_address_group', 'sales_request.prices_include_sales_tax', 'sales_request.sales_name')
                     ->get();
       $countrequest = DB::table('price_request')
                    ->select('product_request.item_number', 'price_request.unit_price')
                    ->join('product_request', 'price_request.product_request_id', '=', 'product_request.id')
                    ->count();
        // sq
        $quotiation = DB::table('quotation_sq')
                     ->select('quotation_sq.quotation', 'quotation_sq.created_date_and_time', 'quotation_sq.invoice_account', 'quotation_sq.name', 'quotation_sq.prospect', 'quotation_sq.customer_address_group', 'quotation_sq.quotation_status', 'quotation_sq.delivery_name')
                     ->get();
        $productsq = DB::table('product_sq')
                     ->select('quotation_sq.quotation','product_sq.qoutation_id', 'product_sq.item_number', 'product_sq.product_name', 'product_sq.search_name', 'product_sq.site', 'product_sq.warehouse', 'product_sq.sales_taker', 'product_sq.sales_responsible', 'product_sq.quantity', 'product_sq.unit_price', 'product_sq.discount_percent', 'product_sq.discount', 'product_sq.net_amount', 'product_sq.dimension_value', 'product_sq.note_1', 'product_sq.note_2', 'product_sq.note_3')
                     ->join('quotation_sq', 'product_sq.qoutation_id', '=', 'quotation_sq.id')
                     ->get();
        $countproductsq = DB::table('product_sq')
                     ->select('product_sq.net_amount', 'quotation_sq.product_name')
                     ->join('quotation_sq', 'product_sq.qoutation_id', '=', 'quotation_sq.id')
                     ->count();

        return view('home', compact(
            'salesreport',
            'customerreport',
            'itemreport',
            'divisionreport',
            'pricereport',
            'shipperreport',
            'priceinvoice',
            'shipperinvoice',
            'salesinvoice',
            'pricerequest',
            'productrequest',
            'salesrequest',
            'quotiation',
            'productsq',
            'countreport',
            'countinvoice',
            'countrequest',
            'countproductsq'
        ));
    }


}
