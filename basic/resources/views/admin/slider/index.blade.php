@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <h4>Home Slider</h4>
                <a href="{{route('add.slider')}}">
                    <button class="btn btn-info">ADD Slider</button>
                </a>
                <br><br>

                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-header">All Slider</div>
                        <div class="card-body">
                            <table class="table badge-secondary">
                                <thead>
                                <tr>
                                    <th scope="col" width="5%">SL</th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="25%">Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                @php($i=1)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$slider->title}}</td>
                                        <td>{{$slider->description}}</td>
                                        <td><img src="{{ asset($slider->image) }}" style="height:50px; width:100px;">
                                        </td>
                                        <td>
                                            <a href="{{url('slider/edit/'.$slider->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{url('slider/delete/'.$slider->id)}}"
                                               onclick="return confirm('Rostdan ochirmoqchimisan')"
                                               class="btn btn-danger">Delete</a>
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
