@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить продукцию</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Добавить продукцию</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <label for="title">Название продукции:</label>
                <input type="text" name="title" id="title"><br/>
                <label for="title">category_id:</label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <label for="description">Описание категории:</label>
                <textarea type="text" name="description" id="description"></textarea><br/>
                <button type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
