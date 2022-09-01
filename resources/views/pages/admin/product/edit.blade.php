@extends('layouts.admin')
@section('title')
Product
@endsection

@section('content')
 <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">Product</h2>
        <p class="dashboard-subtitle">
            Edit Product
        </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input type="text" class="form-control" name="name" placeholder="Nama Product" value="{{ $item->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pemilik Produk</label>
                                            <select name="users_id" class="form-control">
                                                <option value="">Pilih Pemilik Produk</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ ($item->users_id == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori Produk</label>
                                            <select name="categories_id" class="form-control">
                                                <option value="">Pilih Kategori Produk</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($item->categories_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" name="price" value="{{ $item->price }}" placeholder="ex:20000" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="Deskripsi Product" required>{{ $item->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary">Save Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'editor');
</script>
@endpush
