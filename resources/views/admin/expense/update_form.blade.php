<div class="form-group @error('name') has-error @enderror ">
    <label for="cname" class="control-label col-lg-2 text-capitalize">{{__('text.word_name')}} <span style="color:red">*</span></label>
    <div class="col-lg-10">
        <input class=" form-control" name="name" value="{{old('name') ?? $expense->name}}" type="text" required />
        @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-group @error('amount_spend') has-error @enderror">
    <label for="cname" class="control-label col-lg-2 text-capitalize">{{__('text.word_amount')}} <span style="color:red">*</span></label>
    <div class="col-lg-10">
        <input class=" form-control" name="amount_spend" value="{{old('amount_spend') ?? $expense->amount_spend}}" type="number" required />
        @error('amount_spend')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>


<div class="form-group">
    <div class="d-flex justify-content-end col-lg-12">
        <button id="save" class="btn btn-xs btn-primary mx-3 text-capitalize" type="submit">{{__('text.word_save')}}</button>
        <a class="btn btn-xs btn-danger text-capitalize" href="#" type="button">{{__('text.word_cancel')}}</a>
    </div>
</div>