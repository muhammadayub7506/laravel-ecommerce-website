@extends('layouts.admin')
@section('content')
<div class="main-content">

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Slides</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('admin.index')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Slides</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{route('admin.slide.add')}}"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show fs-4" role="alert">
                            <strong>{{Session::get('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('status'))
                        <div class="alert alert-danger alert-dismissible fade show fs-4" role="alert">
                            <strong>{{Session::get('status')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Tagline</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <td>{{$slide->id}}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{asset('uploads/slides')}}/{{$slide->image}}" alt="{{$slide->tagline}}" class="image">
                                        </div>
                                    </td>
                                    <td>{{$slide->tagline}}</td>
                                    <td>{{$slide->title}}</td>
                                    <td>{{$slide->subtitle}}</td>
                                    <td>{{$slide->link}}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{route('admin.slide.edit',['id'=> $slide->id])}}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{route('admin.slide.delete', ['id'=>$slide->id])}}" method="POST" class="delete-form" data-id="{{$slide->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete" style="cursor:pointer">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$slides->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.delete').on('click', function (e) {
                e.preventDefault();
                let form = $(this).closest('.delete-form');
                let couponId = form.data('id');
                let url = form.attr('action');

                swal({
                    title: "Are you sure?",
                    text: "You want to delete this coupon?",
                    icon: "warning",
                    buttons: ['Cancel', 'Delete'],
                    dangerMode: true,
                }).then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: form.find('input[name="_token"]').val(),
                                _method: 'DELETE'
                            },
                            success: function (res) {
                                form.closest('tr').remove(); // Remove row from table
                                swal("Deleted!", "Coupon has been deleted!", "success");
                            },
                            error: function () {
                                swal("Error!", "Something went wrong!", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush