@extends('layouts.load')

@section('content')

<div class="content-area" id="app">
    @include('includes.admin.form-error')
    <form id="geniusformdata" action="{{route('admin-attr-store')}}" method="POST" enctype="multipart/form-data" class="inp-50">
        {{csrf_field()}}
        
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="category_id" value="{{ $data->id }}">
        
        <div class="row">
            <div class="col-md-6">
                <label>English Name</label>
                <input type="text" class="form-control" name="name" placeholder="English Name" required="" value="">
            </div>
            <div class="col-md-6">
                <label>Arabic Name</label>
                <input type="text" class="form-control" name="name_ar" placeholder="Arabic Name" required="" value="">
            </div>
        </div>  
        <div class="row" v-if="counter > 0" id="optionarea">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row mb-2 counterrow" v-for="n in counter" :id="'counterrow'+n">
                        <div class="col-md-5">
                            <label>English Option</label>
                            <input :id="'optionfield'+n" type="text" class="form-control" name="options[]" value="" placeholder="Option label" required>
                        </div>
                        <div class="col-md-5">
                            <label>Arabic Option</label>
                            <input :id="'optionfield'+n" type="text" class="form-control" name="optionsa[]" value="" placeholder="Arabic Option label" required>
                        </div>
                        <div class="col-md-2">
                            <label>Remove</label>
                            <button type="button" class="btn btn-danger text-white d-block" @click="removeOption(n)"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success text-white" @click="addOption()"><i class="fa fa-plus"></i> Add Option</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="priceStatus1" name="price_status" class="custom-control-input" checked value="1">
                    <label class="custom-control-label" for="priceStatus1">Allow Price Field</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="detailsStatus1" name="details_status" class="custom-control-input" checked value="1">
                    <label class="custom-control-label" for="detailsStatus1">Show on Details Page</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-4 text-end">
                <button class="main-dark-btn py-3" type="submit">{{ __("Create Attribute") }}</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        counter: 1
      },
      methods: {
        addOption() {
          $("#optionarea").addClass('d-block');
          this.counter++;
        },
        removeOption(n) {
          $("#counterrow"+n).remove();
          if ($(".counterrow").length == 0) {
            this.counter = 0;
          }
        }
      }
    })
  </script>
@endsection
