@extends('layouts.main')

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Dashboard</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    Dashboard
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<section id="#">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sale Stats</h4>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xl-2 col-lg-6 col-md-12">
                                <div class="btn-group mr-1 mb-1">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Create listing
                                    </button>
                                    <div class="dropdown-menu arrow">
                                        <button class="dropdown-item" type="button" onClick="location.href='create-new-list.html'">Single listing</button>
                                        <button class="dropdown-item" type="button">Multiple listing</button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select Option</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12">
                                <fieldset class="form-group">
                                    <select class="form-control" id="basicSelect">
                                        <option>Select Option</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Enter search keyword" aria-describedby="button-addon2">
                                        <span class="input-group-btn" id="button-addon2">
                                                            <button class="btn btn-primary bg-info border-info" type="button">Search</button>
                                                        </span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <ul class="nav nav-tabs nav-underline no-hover-bg">
                            <li class="nav-item">
                                <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="tab31" href="#tab31" aria-expanded="true">Today <span class="tag tag-default tag-info">65</span> <span class="tag tag-pill  tag-default "> ${{ $total }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#tab32" aria-expanded="false">Yesterday <span class="tag tag-default tag-info">65</span> <span class="tag tag-pill  tag-default "> $4212</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab33" data-toggle="tab" aria-controls="tab33" href="#tab33" aria-expanded="false">Last 7 days <span class="tag tag-default tag-info">65</span> <span class="tag tag-pill  tag-default "> $4212</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab34" data-toggle="tab" aria-controls="tab34" href="#tab34" aria-expanded="false">Last 30 days <span class="tag tag-default tag-info">65</span> <span class="tag tag-pill  tag-default "> $4212</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab35" data-toggle="tab" aria-controls="tab35" href="#tab35" aria-expanded="false">Last 90 days <span class="tag tag-default tag-info">65</span> <span class="tag tag-pill  tag-default "> $4212</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Select shop
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" data-toggle="tab" aria-controls="dropdown1" aria-expanded="true">Amazon</a>
                                    <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" data-toggle="tab" aria-controls="dropdown2" aria-expanded="true">Ebay</a>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="tab31" aria-expanded="true" aria-labelledby="base-tab31">
                                <div id="chart_div1"></div>
                            </div>
                            <div class="tab-pane" id="tab32" aria-labelledby="base-tab32">
                                <div id="chart_div2"></div>
                            </div>
                            <div class="tab-pane" id="tab33" aria-labelledby="base-tab33">
                                <div id="chart_div3"></div>
                            </div>
                            <div class="tab-pane" id="tab34" aria-labelledby="base-tab33">
                                <div id="chart_div4"></div>
                            </div>
                            <div class="tab-pane" id="tab35" aria-labelledby="base-tab33">
                                <div id="chart_div5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section>
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Today's top products</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <!--<div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>-->
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="media-list media-bordered">
                            <div class="media">
                                <a class="media-left" href="#">
                                    <img class="media-object" src="../../../app-assets/images/product/BM10661061.jpg" alt="Product image" style="width: 64px;height: 64px;" />
                                </a>
                                <div class="media-body">
                                    <div class="media-heading text-bold-600"><a href="#">Envelope Style Trunk Cargo Net for Toyota RAV4 2013 - 2017 NEW FREE SHIPPING</a></div>
                                    <code> 50 sold </code>
                                </div>
                            </div>
                            <div class="media">
                                <a class="media-left" href="#">
                                    <img class="media-object" src="../../../app-assets/images/product/BM10661061.jpg" alt="Product image" style="width: 64px;height: 64px;" />
                                </a>
                                <div class="media-body">
                                    <div class="media-heading text-bold-600"><a href="#">Envelope Style Trunk Cargo Net for Toyota RAV4 2013 - 2017 NEW FREE SHIPPING </a></div>
                                    <code> 50 sold </code>
                                </div>
                            </div>
                            <div class="media">
                                <a class="media-left" href="#">
                                    <img class="media-object" src="../../../app-assets/images/product/BM10661061.jpg" alt="Product image" style="width: 64px;height: 64px;" />
                                </a>
                                <div class="media-body">
                                    <div class="media-heading text-bold-600"><a href="#">Envelope Style Trunk Cargo Net for Toyota RAV4 2013 - 2017 NEW FREE SHIPPING</a></div>
                                    <code> 50 sold </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card" style="height: 377px;">
                <div class="card-header">
                    <h4 class="card-title">Recently sold</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">

                            <thead>

                            <tr >
                                <th class="col-sm-8">OrderID#</th>
                                <th class="col-sm-4">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td  class="text-truncate col-sm-8"><a href="#">Envelope Style Trunk Cargo Net for Toyota RAV4 2013 - 2017 NEW </a></td>
                                <td class="text-truncate col-sm-4"><code> 50 sold </code></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card" style="height: 377px;">
                <div class="card-header">
                    <h4 class="card-title">Recently sold</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>OrderID#</th>

                                <th>Status</th>
                                <th>Due</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-truncate"><a href="#">INV-001001</a></td>

                                <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                <td class="text-truncate">10/05/2016</td>
                                <td class="text-truncate">$ 1200.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate"><a href="#">INV-001012</a></td>

                                <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                <td class="text-truncate">20/07/2016</td>
                                <td class="text-truncate">$ 152.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate"><a href="#">INV-001401</a></td>

                                <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                <td class="text-truncate">16/11/2016</td>
                                <td class="text-truncate">$ 1450.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate"><a href="#">INV-01112</a></td>

                                <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                                <td class="text-truncate">11/12/2016</td>
                                <td class="text-truncate">$ 5685.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate"><a href="#">INV-008101</a></td>

                                <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                                <td class="text-truncate">18/05/2016</td>
                                <td class="text-truncate">$ 685.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script src="/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/google/jsapi.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="/app-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/charts/google/line/line.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script>
    google.charts.load('current', { packages: ['corechart', 'line'] });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time of Day');
        data.addColumn('number', 'Amount of sales');

        var orders_data = JSON.parse(JSON.stringify({!! json_encode($grouped_orders->toArray()) !!}));
        var chartData = [];
        for(var i in orders_data){
            var total_sold = 0;
            var orders = orders_data[i];
            for(var j in orders){
                total_sold += parseFloat(orders[j].total);
            }
            chartData.push([[parseInt(i), 0, 0], total_sold]);
        }

        data.addRows(chartData);

        var options = {
            title: 'May 31,2017',
            width: 986,
            height: 400,
            pointSize: 5,
            bar: { groupWidth: '95%' },

            hAxis: {
                title: moment().format('MMM Do, YYYY'),
                titleTextStyle: { italic: false },
                gridlines: { count: 12 }
            },
            vAxis: {
                title: 'Price in $',
                titleTextStyle: { italic: false },
                gridlines: { count: 7 }
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));

        chart.draw(data, options);
    }

</script>


@endsection