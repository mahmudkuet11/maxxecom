@extends('layouts.main')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/pickers/daterange/daterange.min.css">
@endsection

@section('content_header')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h2 class="content-header-title">Revise Listing</h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="home.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="home.html">Selling Manager Pro</a>
                </li>
                <li class="breadcrumb-item active">
                    Revise listing
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="icon-tabs">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">To create new listings just complete this wizard</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div action="#" class="icons-tab-steps wizard-circle">
                            <!-- Step 1 -->
                            <h6><i class="step-icon icon-home4"></i> Product details</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName2">Title :</label>
                                            <input type="text" class="form-control" id="firstName2">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress3">Custom label :</label>
                                            <input type="email" class="form-control" id="emailAddress3">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress3">Second category :</label>
                                            <input type="email" class="form-control" id="#" value="Add a category">

                                        </div>
                                        <div class="form-group">
                                            <label for="eventType2">UPC</label>
                                            <select class="custom-select form-control" id="eventType2" data-placeholder="Type to search cities" name="eventType2">
                                                <option value="Banquet">Banquet</option>
                                                <option value="Fund Raiser">Fund Raiser</option>
                                                <option value="Dinner Party">Dinner Party</option>
                                                <option value="Wedding">Wedding</option>
                                            </select>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName2">Subtitle :</label>
                                            <input type="text" class="form-control" id="lastName2">
                                        </div>
                                        <div class="form-group">
                                            <label for="location2">Category :</label><small class="text-muted">$9999</small>
                                            <input type="email" class="form-control" id="#" value="eBay Motors> Parts & Truck Parts> Exterior> Grilles">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventType2">Store categories :</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="eventType2" data-placeholder="Other" name="eventType2">
                                                        <option value="other">other</option>
                                                        <option value="other1">other1</option>
                                                        <option value="other2">other2</option>
                                                        <option value="other3">other3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="custom-select form-control" id="eventType2" data-placeholder="----" name="eventType2">
                                                        <option value="--">--</option>
                                                        <option value="-- --">-- --</option>
                                                        <option value="-- --">-- --</option>
                                                        <option value="--">--</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="eventType2">Category :</label> <small class="text-muted"> A brand new product should have maintained intact packaging</small>
                                            <select class="custom-select form-control" id="eventType2" data-placeholder="Type to search cities" name="eventType2">
                                                <option value="Banquet">Banquet</option>
                                                <option value="Fund Raiser">Fund Raiser</option>
                                                <option value="Dinner Party">Dinner Party</option>
                                                <option value="Wedding">Wedding</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 class="form-section"><i class="icon-file-text"></i> Upload images</h4>
                                            <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                                <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                <div class="row fileupload-buttonbar">
                                                    <div class="col-lg-7">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                                        <span class="btn btn-success fileinput-button mr-1">
                                                                            <i class="icon-plus4"></i>
                                                                            <span>Add files...</span>
                                                                            <input type="file" name="files[]" multiple>
                                                                        </span>
                                                        <button type="submit" class="btn btn-primary start mr-1">
                                                            <i class="icon-cloud-upload3"></i>
                                                            <span>Start upload</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning cancel mr-1">
                                                            <i class="icon-ban2"></i>
                                                            <span>Cancel upload</span>
                                                        </button>
                                                        <button type="button" class="btn btn-danger delete mr-1">
                                                            <i class="icon-trash4"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                        <input type="checkbox" class="toggle">
                                                        <!-- The global file processing state -->
                                                        <span class="fileupload-process"></span>
                                                    </div>
                                                    <!-- The global progress state -->
                                                    <div class="col-lg-5 fileupload-progress fade">
                                                        <!-- The global progress bar -->
                                                        <progress class="progress progress-striped progress-success" value="0" max="100"></progress>
                                                        <!-- The extended global progress state -->
                                                        <div class="progress-extended">&nbsp;</div>
                                                    </div>
                                                </div>
                                                <!-- The table listing the files available for upload/download -->
                                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                            </form>
                                            <!-- The blueimp Gallery widget -->
                                            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                                <div class="slides"></div>
                                                <span class="title font-medium-3"></span>
                                                <a class="prev">‹</a>
                                                <a class="next">›</a>
                                                <a class="close">×</a>
                                                <a class="play-pause"></a>
                                                <ol class="indicator"></ol>
                                            </div>
                                            <!-- The template to display files available for upload -->
                                            <script id="template-upload" type="text/x-tmpl">
                                                                {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                                <tr class="template-upload fade">
                                                                    <td>
                                                                        <span class="preview"></span>
                                                                    </td>
                                                                    <td>
                                                                        <p class="name">{%=file.name%}</p>
                                                                        <strong class="error text-danger"></strong>
                                                                    </td>
                                                                    <td>
                                                                        <p class="size">Processing...</p>
                                                                        <progress class="progress progress-striped progress-success" value="0" max="100"></progress>
                                                                    </td>
                                                                    <td>
                                                                        {% if (!i && !o.options.autoUpload) { %}
                                                                        <button class="btn btn-primary start" disabled>
                                                                            <i class="icon-cloud-upload3"></i>
                                                                            <span>Start</span>
                                                                        </button>
                                                                        {% } %}
                                                                        {% if (!i) { %}
                                                                        <button class="btn btn-warning cancel">
                                                                            <i class="icon-ban2"></i>
                                                                            <span>Cancel</span>
                                                                        </button>
                                                                        {% } %}
                                                                    </td>
                                                                </tr>
                                                                {% } %}
                                                            </script>
                                            <!-- The template to display files available for download -->
                                            <script id="template-download" type="text/x-tmpl">
                                                                {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                                <tr class="template-download fade">
                                                                    <td>
                                                                        <span class="preview">
                                                                            {% if (file.thumbnailUrl) { %}
                                                                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                                                            {% } %}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <p class="name">
                                                                            {% if (file.url) { %}
                                                                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                                                            {% } else { %}
                                                                            <span>{%=file.name%}</span>
                                                                            {% } %}
                                                                        </p>
                                                                        {% if (file.error) { %}
                                                                        <div><span class="tag tag-default tag-danger">Error</span> {%=file.error%}</div>
                                                                        {% } %}
                                                                    </td>
                                                                    <td>
                                                                        <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                                                    </td>
                                                                    <td>
                                                                        {% if (file.deleteUrl) { %}
                                                                        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                                                            <i class="icon-trash4"></i>
                                                                            <span>Delete</span>
                                                                        </button>
                                                                        <input type="checkbox" name="delete" value="1" class="toggle">
                                                                        {% } else { %}
                                                                        <button class="btn btn-warning cancel">
                                                                            <i class="icon-ban2"></i>
                                                                            <span>Cancel</span>
                                                                        </button>
                                                                        {% } %}
                                                                    </td>
                                                                </tr>
                                                                {% } %}
                                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i> Item specifies</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput5">Brand</label>
                                                        <select id="projectinput5" name="interested" class="form-control">
                                                            <option value="none" selected="" disabled="">Aftermarket replacement</option>
                                                            <option value="design">design</option>
                                                            <option value="development">development</option>
                                                            <option value="illustration">illustration</option>
                                                            <option value="branding">branding</option>
                                                            <option value="video">video</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Manufacturer part number</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">55077723AB</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Interchange part number</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">55077723AB</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Other part number</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">55077723AB</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput5">Placement in vehicle</label>
                                                        <select id="projectinput5" name="interested" class="form-control">
                                                            <option value="none" selected="" disabled="">Left</option>
                                                            <option value="design">Right</option>
                                                            <option value="development">Front</option>
                                                            <option value="illustration">Upper</option>
                                                            <option value="branding">Lower</option>
                                                            <option value="video">Rear</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Surface fininsh</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Chrome and black</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Warranty</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Yes</option>
                                                            <option value="less than 5000$">no</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Type</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Budget</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput5">Fitment type</label>
                                                        <select id="projectinput5" name="interested" class="form-control">
                                                            <option value="none" selected="" disabled="">Left</option>
                                                            <option value="design">Right</option>
                                                            <option value="development">Front</option>
                                                            <option value="illustration">Upper</option>
                                                            <option value="branding">Lower</option>
                                                            <option value="video">Rear</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Material</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Chrome and black</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Country or region of manufacturer</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Yes</option>
                                                            <option value="less than 5000$">no</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Superseded Part Number</label>
                                                        <select id="projectinput6" name="budget" class="form-control">
                                                            <option value="0" selected="" disabled="">Budget</option>
                                                            <option value="less than 5000$">less than 5000$</option>
                                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                                            <option value="more than 20000$">more than 20000$</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i>Compatibility</h4>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <h5>Specify vehicles that this item fits</h5>

                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#xlarge">
                                                            Add or edit compatible vehicles
                                                        </button>

                                                        <div class="card box-shadow-0 card-outline-info">
                                                            <div class="card-header">
                                                                <span ><code>05</code> compatible vehicles added </span>
                                                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                                                <div class="heading-elements">
                                                                    <ul class="list-inline mb-0">
                                                                        <li><a data-toggle="modal" data-target="#xlarge"><i class="icon-edit"></i></a></li>

                                                                        <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-body collapse in">
                                                                <table class="table table-hover mb-0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Brand</th>
                                                                        <th>Model</th>
                                                                        <th>year</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="text-truncate">Lexus</td>
                                                                        <td class="text-truncate">GS300</td>
                                                                        <td class="text-truncate"><span class="tag tag-default tag-success">1997-1993</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-truncate">American Austin</td>
                                                                        <td class="text-truncate">MX300</td>
                                                                        <td class="text-truncate"><span class="tag tag-default tag-success">2004-2008</span></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade text-xs-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel16">Add or edit compatible vehicles</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <h5>
                                                                                        Select car brand
                                                                                    </h5>
                                                                                    <select class="select2 form-control block" multiple="multiple" id="responsive_multi" style="width: 100%">
                                                                                        <option value="LX">Lexas</option>
                                                                                        <option value="AM">Aston Martin</option>
                                                                                        <option value="AA">American Austin</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <h5>
                                                                                        Select car model
                                                                                    </h5>
                                                                                    <select class="select2 form-control block" multiple="multiple" id="responsive_multi" style="width: 100%">
                                                                                        <option value="LX">Lexus GS300</option>
                                                                                        <option value="AM">Aston GS300</option>
                                                                                        <option value="AA">American GS300</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <h5>
                                                                                        Select model year
                                                                                    </h5>
                                                                                    <select class="select2 form-control block" multiple="multiple" id="responsive_multi" style="width: 100%">
                                                                                        <option value="1997">1997</option>
                                                                                        <option value="1998">1998</option>
                                                                                        <option value="1999">1999</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <section id="child-row">
                                                                            <table class="table table-striped table-bordered show-child-rows" width="100%">
                                                                                <thead>
                                                                                <tr>

                                                                                    <th><input type='checkbox' /></th>
                                                                                    <th>Select trim</th>
                                                                                    <th>Brand</th>
                                                                                    <th>Model</th>
                                                                                    <th>Year</th>
                                                                                    <th>Notes</th>
                                                                                </tr>
                                                                                </thead>

                                                                            </table>
                                                                        </section>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-outline-primary">Save vehicles</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <h4 class="form-section"><i class="icon-file-text"></i>Item description</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <textarea name="shortDescription" id="shortDescription2" rows="8" class="form-control editor"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 2 -->
                            <h6><i class="step-icon icon-pencil"></i>Selling details</h6>
                            <fieldset>
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-head"></i> Selling details</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Format</label>
                                            <div class="col-md-9">
                                                <select id="projectinput6" name="interested" class="form-control">
                                                    <option value="none" selected="" disabled="">Fixed price</option>
                                                    <option value="design">design</option>
                                                    <option value="development">development</option>
                                                    <option value="illustration">illustration</option>
                                                    <option value="branding">branding</option>
                                                    <option value="video">video</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Duration</label>
                                            <div class="col-md-9">
                                                <select id="projectinput6" name="interested" class="form-control">
                                                    <option value="none" selected="" disabled="">Good till cancelled</option>
                                                    <option value="design">design</option>
                                                    <option value="development">development</option>
                                                    <option value="illustration">illustration</option>
                                                    <option value="branding">branding</option>
                                                    <option value="video">video</option>
                                                </select>
                                                <p class="text-muted">Muted help text using <code>.text-muted</code> class.</p>
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked1" name="radio-stacked1" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Start my listings when I submit them</span>
                                                    </label>
                                                </fieldset>
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked2" name="radio-stacked1" type="radio" checked class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Schedule to start on <input type="datetime-local" class="" id="dateTime" value="2011-08-19T13:45:00"></span>
                                                    </label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Price</label>


                                            <div class="col-md-9">
                                                <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD" />

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput2">quantity</label>
                                            <div class="col-md-9">
                                                <input type="number" id="projectinput2" class="form-control" placeholder="Quantity" name="lname">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput3">Payment options</label>
                                            <div class="col-md-9">
                                                <div class="c-inputs-stacked">
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input" checked>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Paypal</span>
                                                    </label>
                                                </div>
                                                <input type="text" id="projectinput3" class="custom-form-control" placeholder="Email address for payment" name="email">
                                                <label class="inline custom-control custom-checkbox block">
                                                    <input type="checkbox" class="custom-control-input" checked>
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description ml-0">Require immediate payment with <span style="font-weight:bold;">Buy It Now</span></span>
                                                </label>
                                                <p>Additional checkout instructions (shows in your listing)</p>
                                                <textarea rows="8" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Return options</label>
                                            <div class="col-md-9">
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked1" name="radio-stacked1" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Returns accepted</span>
                                                    </label>
                                                    <p>After receiving the item, your buyer should start a return within</p>
                                                    <select id="projectinput7" name="budget" class="form-control">
                                                        <option value="30 days" selected="" disabled="">30 days</option>
                                                        <option value="60 days">60 days</option>
                                                        <option value="90 days">90 days</option>
                                                    </select>
                                                    <p>Refund will be given as</p>
                                                    <select id="projectinput7" name="budget" class="form-control">
                                                        <option value="Money Back" selected="" disabled="">Money Back</option>
                                                        <option value="Different products">Different products</option>

                                                    </select>
                                                    <p>Return shipping will be paid by:</p>
                                                    <select id="projectinput7" name="budget" class="form-control">
                                                        <option value="Money Back" selected="" disabled="">Buyer</option>
                                                        <option value="Different products">Customer </option>

                                                    </select>
                                                    <p class="text-muted">If your browser returns this item because this item is not as described in the listing, you'll be charged return shipping on your seller invoice as a fee.</p>
                                                    <p>Additional return policy details</p>
                                                    <textarea rows="6" class="form-control"></textarea>
                                                    <p>Do you charge a restocking fee?</p>
                                                    <select id="projectinput7" name="budget" class="form-control">
                                                        <option value="60%" selected="" disabled="">20%</option>
                                                        <option value="40%">40% </option>

                                                    </select>
                                                </fieldset>
                                                <br />
                                                <fieldset>
                                                    <label class="custom-control custom-radio">
                                                        <input id="radioStacked2" name="radio-stacked1" type="radio" checked class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Returns not accepted </span>
                                                    </label>
                                                    <p class="text-muted">The item could still be returned if it doesn't match the listing's descriptions.</p>
                                                </fieldset>


                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </fieldset>
                            <!-- Step 3 -->
                            <h6><i class="step-icon icon-monitor3"></i>Shipping details</h6>
                            <fieldset>
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-head"></i> Shipping details</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Domestic shipping</label>
                                            <div class="col-md-9">
                                                <select id="projectinput6" name="interested" class="form-control">
                                                    <option value="none" selected="" disabled="">Flat: same cost to all buyers</option>
                                                    <option value="design">design</option>
                                                    <option value="development">development</option>
                                                    <option value="illustration">illustration</option>
                                                    <option value="branding">branding</option>
                                                    <option value="video">video</option>
                                                </select>
                                                <div class="c-inputs-stacked">
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input" checked>
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description ml-0">Use my rate tables</span>

                                                    </label>

                                                </div>
                                                <a class="cm-link" href="#">Create/Edit rate tables</a>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput3">Services</label><a href="#" target="_blank"> Calculate Shipping</a>
                                                            <input type="text" class="form-control">
                                                            <div class="c-inputs-stacked">
                                                                <label class="inline custom-control custom-checkbox block">
                                                                    <input type="checkbox" class="custom-control-input" checked>
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description ml-0">Add a surcharge for Alaska, Hawawii and Puerto Rico</span><input />

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Cost</label>
                                                            <label class="inline custom-control custom-checkbox block">
                                                                <input type="checkbox" class="custom-control-input" checked>
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description ml-0"> <a href="#" target="_blank"> Free shipping</a></span>
                                                            </label>
                                                            <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput3">Services</label><a href="#" target="_blank"> Offer additional service</a>
                                                            <input type="text" class="form-control">
                                                            <div class="c-inputs-stacked">
                                                                <label class="inline custom-control custom-checkbox block">
                                                                    <input type="checkbox" class="custom-control-input" checked>
                                                                    <span class="custom-control-indicator"></span>
                                                                    <span class="custom-control-description ml-0">Add a surcharge for Alaska, Hawawii and Puerto Rico</span><input />

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Cost</label>
                                                            <a href="#" target="_blank">Remove service</a>
                                                            <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <label class="inline custom-control custom-checkbox block">
                                                                <input type="checkbox" class="custom-control-input" checked>
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description ml-0">Offer local pickup</span>
                                                            </label>
                                                            <input type="text" id="issueinput4" class="form-control" placeholder="Enter pickup cost">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput4">Cost</label>
                                                            Handling time
                                                            <select id="projectinput6" name="interested" class="form-control">
                                                                <option value="none" selected="" disabled="">1 business day</option>
                                                                <option value="design">design</option>
                                                                <option value="development">development</option>
                                                                <option value="illustration">illustration</option>
                                                                <option value="branding">branding</option>
                                                                <option value="video">video</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Package weight & dimensions</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="projectinput5">Package Type</label>
                                                            <select id="projectinput5" name="interested" class="form-control">
                                                                <option value="none" selected="" disabled="">Package of thick envelop</option>
                                                                <option value="design">design</option>
                                                                <option value="development">development</option>
                                                                <option value="illustration">illustration</option>
                                                                <option value="branding">branding</option>
                                                                <option value="video">video</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="eventType2">Dimensions :</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="number" id="issueinput4" class="form-control" placeholder="width in inch">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" id="issueinput4" class="form-control" placeholder="width in inch">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" id="issueinput4" class="form-control" placeholder="width in inch">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>




                                                </div>
                                                <div class="form-group">
                                                    <label for="eventType2">Weight :</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select id="projectinput5" name="interested" class="form-control">
                                                                <option value="none" selected="" disabled="">Custom weight</option>
                                                                <option value="design">design</option>
                                                                <option value="development">development</option>
                                                                <option value="illustration">illustration</option>
                                                                <option value="branding">branding</option>
                                                                <option value="video">video</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" id="issueinput4" class="form-control" placeholder="width in inch">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" id="issueinput4" class="form-control" placeholder="width in inch">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Excluded shippiing locations</label>
                                            <div class="col-md-9">
                                                <p>Alaska/Hawaii, US Protectorates, APO/FPO, Equatorial Guinea, Kenya, Egypt, Niger, Zambia</p>
                                                <a href="#">Edit list</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput6">Item location</label>
                                            <div class="col-md-9">
                                                <p>Alaska/Hawaii, US Protectorates, APO/FPO, Equatorial Guinea, Kenya, Egypt, Niger, Zambia</p>
                                                <a href="#">Edit list</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </fieldset>
                            <!-- Step 4 -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@parent
<script src="/app-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/wizard-steps.min.js" type="text/javascript"></script>
@endsection
