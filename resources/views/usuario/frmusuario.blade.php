@extends('layouts.diseñousuario')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Table</strong>
                </div>
                <div class="card-body">
                    <div id="bootstrap-data-table_wrapper"
                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="bootstrap-data-table_length">
                                    <label>Show <select name="bootstrap-data-table_length"
                                            aria-controls="bootstrap-data-table" class="form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="-1">All</option>
                                        </select> entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="bootstrap-data-table_filter" class="dataTables_filter">
                                    <label>Search:
                                        <input type="search" class="form-control form-control-sm" placeholder=""
                                            aria-controls="bootstrap-data-table"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="bootstrap-data-table"
                                    class="table table-striped table-bordered dataTable no-footer" role="grid"
                                    aria-describedby="bootstrap-data-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                                                rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table"
                                                rowspan="1" colspan="1" style="width: 509px;"
                                                aria-label="Position: activate to sort column ascending">Position</th>
                                            <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table"
                                                rowspan="1" colspan="1" style="width: 249px;"
                                                aria-label="Office: activate to sort column ascending">Office</th>
                                            <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table"
                                                rowspan="1" colspan="1" style="width: 197px;"
                                                aria-label="Salary: activate to sort column ascending">Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="bootstrap-data-table_info" role="status"
                                    aria-live="polite">Showing 1 to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="bootstrap-data-table_previous">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="0" tabindex="0"
                                                class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item active">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="2" tabindex="0"
                                                class="page-link">2</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="3" tabindex="0"
                                                class="page-link">3</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0"
                                                class="page-link">4</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="5" tabindex="0"
                                                class="page-link">5</a>
                                        </li>
                                        <li class="paginate_button page-item ">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="6" tabindex="0"
                                                class="page-link">6</a>
                                        </li>
                                        <li class="paginate_button page-item next" id="bootstrap-data-table_next">
                                            <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="7" tabindex="0"
                                                class="page-link">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>
@endsection
