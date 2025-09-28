@extends('admin.layout.app')

@section('heading', 'View Slide')

@section('main_content')

   <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Photo</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($slides as $row)
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <img src="{{asset('uploads/'.$row->photo)}}" alt="" class="w_200">
                                                    </td>
                                                    
                                                    <td class="pt_10 pb_10">
                                                        
                                                        <a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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
                   
@endsection