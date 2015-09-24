@section('content')
    

    <script>

        $(function()
        {
            $('[type=checkbox][name=customizable]').prop("checked", false);
        });

    </script>
    
    <div class="content-div">

        {{ Form::open(array('url'=>'admin/products/save', 'class' => 'form-horizontal', 'files' => true)) }}

            <div style="margin: 0 0 30px 0;">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-floppy"></i> Add
                </button>

                <a href="{{ URL::to('admin/products') }}" class="btn btn-default btn-sm">
                    <i class="glyphicon glyphicon-remove"></i> Cancel
                </a>
            </div>

            <div id="display_message" style="margin: 0 0 10px 0;">
                @if(Session::has('message'))s
                    {{ Session::get('message') }}
                @endif

               @if( $errors->any() )
                    <div class="alert alert-danger">
                        <b>Error(s) encounter:</b> 
                        
                        @if($errors->any())
                            Field indicated with (*) is required.
                        @endif

                    </div>
                @endif
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Name: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_name', '', array('class' => 'formInputs form-control input-sm', 'id' => 'product_name')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Description:</div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_desc', '', array('class' => 'formInputs form-control input-sm', 'id' => 'product_desc')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Category: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">

                            <?php 
                                $category = array("0" => "Select"); 
                            ?>
                            @foreach( App::make('GlobalController')->listCategories() as $value )
                                <?php
                                    $category[$value->category_id] = $value->category_name;
                                 ?>
                            @endforeach

                            {{ Form::select('category', $category, '0', array('class' => 'formInputs form-control input-sm')) }}


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Dimensions: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('dimensions', '', array('class' => 'formInputs form-control input-sm', 'id' => 'dimensions', 'placeholder' => 'eg. 570w x 450d x 770h')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Cost: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_cost', '', array('class' => 'formInputs form-control input-sm', 'id' => 'product_cost')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Stock: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('stock', '', array('class' => 'formInputs form-control input-sm', 'id' => 'stock')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Color:</div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('colors', '', array('class' => 'formInputs form-control input-sm', 'id' => 'stock')) }}<span class="text-danger pull-right" style="font-size: 10px;">Leave blank if color is not available. <br> Semi-colon(;) delimited for multiple colors.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">&nbsp;</div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::checkbox('customizable', '1', array('id' => 'customize_check')); }} Customizable
                        </div>
                    </div>

                </div>


                <div class="col-md-6">

                    <div id="product_image_div">

                        <div class="form-group" style="margin: 0 -15px">
                            <div class="alert alert-info">
                                <b>Product Image(s)</b>
                                <div class="pull-right">
                                    <a class="add_image" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to add more parts."><i class="glyphicon glyphicon-plus"></i> Product image</a>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div id="customize_div" style="display: none; margin: 30px 0 0 0;">
                        
                        <div class="form-group" style="margin: 0 -15px">
                            <div class="alert alert-info">
                                <b>Product's Customizable Parts</b>
                                <div class="pull-right">
                                    <a class="add_parts" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to add more parts."><i class="glyphicon glyphicon-plus"></i> Parts</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        {{ Form::close() }}

  


    </div>

@stop