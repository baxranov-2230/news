<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <div class="card-header">All category</div>
                        <div class="card-body">
                            <table class="table badge-info">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created AT</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php($i=1)
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->user_id}}</td>

                                        <td>
                                            @if($category->created_at==NULL)
                                                <span class="text-danger">No DateSet</span>
                                            @else
                                                {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add header</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                    @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>