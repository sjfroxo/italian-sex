@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @inject('categories', 'App\Models\Category')
                    @if($selectedCategoryId && $categories::all()->isNotEmpty())
                        @php
                            $selectedCategory = $categories->firstWhere('id', $selectedCategoryId);
                        @endphp

                        <h1>{{ $selectedCategory ? $selectedCategory->title : 'Продукция' }}</h1>
                    @else
                        <h1>Вся продукция</h1>
                    @endif
                    @if(!$selectedCategoryId)
                        <div>
                            <a href="{{ route('product.create') }}" class="nav-link">
                                <p>Добавить продукцию</p>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ $selectedCategoryId ? ($selectedCategory->title ?? 'Продукция') : 'Вся продукция' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach($products as $product)
                        <div style="margin: 50px;" class="product-item">
                            ID: {{ $product->id }}<br/>
                            Название: {{ $product->title }}<br/>
                            SLUG: {{ $product->slug }}<br/>
                            Описание: {{ $product->description }}<br/>
                            Дата создания: {{ $product->created_at }}<br/>
                            Дата изменения: {{ $product->updated_at }}<br/>
                            <div style="display: flex;">
                                <a href="{{ route('product.edit', $product->slug) }}">Изменить</a>
                                <form action="{{ route('product.destroy', $product->slug) }}" method="POST">
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
