@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-6">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Report</h4>
                            </div>
                            <div class="card-body">
                                <h4>{{$countreport}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Invoice</h4>
                            </div>
                            <div class="card-body">
                                <h4>{{$countinvoice}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Request</h4>
                            </div>
                            <div class="card-body">
                                <h4>{{$countrequest}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah product sq</h4>
                            </div>
                            <div class="card-body">
                                <h4>{{$countproductsq}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Jumlah Data</h4>
                            </div>
                            <div class="row card-body">
                                <div class="col-md-5">
                                    <h5 class="text-center">Data Request</h5>
                                    <div class="form-group">
                                        <label for="periode">Request</label>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Flag</th>
                                                        <th>Sales Order</th>
                                                        <th>Customer</th>
                                                        <th>Name</th>
                                                        <th>Sales Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($salesrequest as $request)
                                                    <tr>
                                                        <td>{{ $request->flag }}</td>
                                                        <td>{{ $request->sales_order }}</td>
                                                        <td>{{ $request->customer }}</td>
                                                        <td>{{ $request->name }}</td>
                                                        <td>{{ $request->sales_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <h6 class="mt-4">Product Request</h6>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Sales Order</th>
                                                        <th>Item Number</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($productrequest as $product)
                                                    <tr>
                                                        <td>{{ $product->sales_order }}</td>
                                                        <td>{{ $product->item_number }}</td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>{{ $product->quantity }}</td>
                                                        <td>{{ $product->unit }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-6">
                                    <h5 class="text-center">Data Report</h5>
                                    <div class="form-group">
                                        <label for="periode">Report</label>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Company</th>
                                                        <th>Sales Order</th>
                                                        <th>PO Number</th>
                                                        <th>Invoice</th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($salesreport as $report)
                                                    <tr>
                                                        <td>{{ $report->company }}</td>
                                                        <td>{{ $report->sales_order }}</td>
                                                        <td>{{ $report->po_number }}</td>
                                                        <td>{{ $report->invoice }}</td>
                                                        <td>{{ $report->name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <h6 class="mt-4">Item Report</h6>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Sales Order</th>
                                                        <th>Item Number</th>
                                                        <th>Item Name</th>
                                                        <th>Group Product</th>
                                                        <th>Qty</th>
                                                        <th>Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($itemreport as $item)
                                                    <tr>
                                                        <td>{{ $item->sales_order }}</td>
                                                        <td>{{ $item->item_number }}</td>
                                                        <td>{{ $item->item_name }}</td>
                                                        <td>{{ $item->group_product }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ $item->unit }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
