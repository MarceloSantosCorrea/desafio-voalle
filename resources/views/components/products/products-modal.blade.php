<div class="modal fade" id="modal-products" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Products') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="product">{{ __('Products') }}</label>
                        <select
                            class="form-control @error('product') is-invalid @enderror"
                            id="product"
                            name="product"
                            required
                        >
                            <option value="">{{ __('Select...') }}</option>
                            @foreach($products as $product)
                                <option value="{{ "{$product->id}|{$product->price}|{$product->name}" }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="modal-products-btn">{{ __('Select') }}</button>
            </div>
        </div>
    </div>
</div>
