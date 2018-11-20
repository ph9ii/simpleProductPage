@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Add new product</h1></div>
            	<div class="panel-body">
  					<form method="post" action="{{ route('shop.store') }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Product title</label>
                            <input type="text" name="title" id="title" class="form-control"
                            placeholder="Product title" required autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity in stock</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" 
                            placeholder="Quantity">
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price">Price per item</label>
                            <input type="number" name="price" id="price" class="form-control"
                            placeholder="Price in USD">
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>                      
                </div>
                
                <div class="panel-heading"><h2>Browse products</h2></div>

                <div class="panel-body">
                    <table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Product name</th>
					      <th scope="col">Quantity in stock</th>
					      <th scope="col">Price per item</th>
                          <th scope="col">Datetime submitted</th>
                          <th scope="col">Total value number</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($products as $product)
					    <tr>
					      <th scope="row">{{ $product->id }}</th>
					      <td>{{ $product->title }}</td>
					      <td>
                            @if($product->quantity <= 0)
                                Out Of Stock
                            @else
                                {{ $product->quantity }}
                            @endif
                          </td>
					      <td>{{ $product->price }} {{ $product->currency }}</td>
                          <th scope="row">{{ $product->created_at }}</th>
                          <th scope="row">{{ $product->total }} {{ $product->currency }}</th>
					    </tr>
					    @endforeach
					  </tbody>
					  <?php echo $products->render(); ?>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
