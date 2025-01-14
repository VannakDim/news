@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Recent Order Table -->
                        <div class="card card-table-border-none" id="recent-orders">
                            <div class="card-header justify-content-between">
                                <h2><strong>PRODUCT AVAILABLE</strong></h2>
                                <div class="date-range-report ">
                                    <span></span>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Model</th>
                                            <th class="d-none d-md-table-cell">Brand</th>
                                            <th class="d-none d-md-table-cell">Available</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $stock)
                                            <tr>
                                                <td>{{ $stock['id'] }}</td>
                                                <td>
                                                    <a class="text-dark" href=""> {{ $stock['model_name'] }}</a>
                                                </td>
                                                <td>{{ $stock['brand_name'] }}</td>
                                                <td>{{ $stock['available_stock'] }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown show d-inline-block widget-dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href=""
                                                            role="button" id="dropdown-recent-order1"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static"></a>
                                                        <ul class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="dropdown-recent-order1">
                                                            <li class="dropdown-item">
                                                                <a href="#">View</a>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <a href="#">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
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
@endsection
