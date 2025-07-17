@extends('dashboard')
@section('content')
<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2">
                @include('sidebar')
            </div>
            <div class="col col-md-10">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title float-left m-0">{{ $category->name }}</h3>
                        <span class="float-right">
                            <span class="float-right">
                                <a href="{{ route('category.view') }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-angle-double-left" aria-hidden="true"></span> Quay lại</a>
                                <a href="{{ route('category.edit', $category->id) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" data-model="laravel-crm::lang.product"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </span>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="content-detail pb-3">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin</button>
                                </li>
                                <li>
                                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nội dung</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <dt class="col-sm-3 mb-3 text-right">Mã danh mục:</dt>
                                                <dd class="col-sm-9 mb-3">{{ $category->code }}</dd>
                                                <dt class="col-sm-3 mb-3 text-right">Mô tả ngắn:</dt>
                                                <dd class="col-sm-9 mb-3">
                                                    <div class="media-body">
                                                        {{ $category->short_content }}
                                                    </div>
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            </div>
                        </div>
                    </div>  
                </div>                
            </div>
        </div>
    </div>
</main>
@endsection