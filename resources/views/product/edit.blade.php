@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать продукт</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Редактировать продукт</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('product.update', $product->slug) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="title">Название продукции:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}"><br/>

                <label for="category_id">category_id:</label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>

                <label for="description">Описание категории:</label>
                <textarea
                    type="text"
                    name="description"
                    id="description">
                    {{ value(old('description', $product->description)) }}
                </textarea><br/>

                <button type="submit">Сохранить</button>
            </form>
        </div>
    </section>
@endsection
