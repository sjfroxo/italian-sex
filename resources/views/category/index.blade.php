@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Категории</h1>
                    <a href="{{ route('category.create') }}" class="nav-link">
                        <p>Добавить категорию</p>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Категории</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach($categories as $category)
                        <div style="margin: 50px;" class="category-item">
                            ID: {{ $category->id }}<br/>
                            Название: {{ $category->title }}<br/>
                            SLUG: {{ $category->slug }}<br/>
                            Описание: {{ $category->description }}<br/>
                            Дата создания: {{ $category->created_at }}<br/>
                            Дата изменения: {{ $category->updated_at }}<br/>
                            <div style="display: flex;">
                                <a href="{{ route('category.edit', $category->slug) }}">Изменить</a>
                                <form action="{{ route('category.destroy', $category->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </section>
@endsection
