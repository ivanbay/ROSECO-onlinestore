@section('content')
    
    <div class="content-div">

        {{ Form::open(array('url'=>'admin/products/update', 'class' => 'form-horizontal', 'files' => true)) }}

            <div style="margin: 0 0 30px 0;">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-floppy"></i> Save
                </button>

                <button type="submit" class="editDeletebtn btn btn-danger btn-sm">
                    <i class="glyphicon glyphicon-floppy"></i> Delete Selected
                </button>

                <a href="{{ URL::to('admin/products') }}" class="btn btn-default btn-sm">
                    <i class="glyphicon glyphicon-remove"></i> Cancel
                </a>
            </div>

            <div id="display_message" style="margin: 0 0 10px 0;">
                @if(Session::has('message'))
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
                        {{ Form::hidden('prod_id', $products['product_id']) }}
                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Name: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_name', $products['name'], array('class' => 'formInputs form-control', 'id' => 'product_name')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Description:</div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_desc', $products['description'], array('class' => 'formInputs form-control', 'id' => 'product_desc')) }}
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

                            {{ Form::select('category', $category, $products['category_id'], array('class' => 'formInputs form-control')) }}


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Dimensions: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('dimensions', $products['dimensions'], array('class' => 'formInputs form-control', 'id' => 'dimensions', 'placeholder' => 'eg. 570w x 450d x 770h')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Product Cost: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('product_cost', $products['cost'], array('class' => 'formInputs form-control', 'id' => 'product_cost')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Stock: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('stock', $products['stock'], array('class' => 'formInputs form-control', 'id' => 'stock')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">Stock: <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('colors', $products['colors'], array('class' => 'formInputs form-control', 'id' => 'colors')) }}<span class="text-danger pull-right" style="font-size: 10px;">Leave blank if color is not available. <br> Semi-colon(;) delimited for multiple colors.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label_div">
                            <div class="label_text">&nbsp;</div>
                        </div>
                        <div class="col-sm-6">

                            @if( $products['customizable'] == '1')

                                {{ Form::checkbox('customizable', '1', array('id' => 'customize_check', 'checked' => true)); }} Customizable

                            @else

                                {{ Form::checkbox('customizable', '1', array('id' => 'customize_check')); }} Customizable

                            @endif
                            
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

                        <div style="margin: 0 0 20px;" class="clearfix">

                            @foreach( $products['product_img'] as $img )
                                
                                @if( $img != NULL )
                                
                                    <div style="position: relative; float: left; margin: 0 0 10px 10px;"> 
                                        {{ HTML::image('product_images/' . $img, '...', array('class' => 'img-thumbnail', 'width' => '100px')) }}
                                        {{ Form::checkbox('del_prod_image[]', $img, false, array('style' => 'position: absolute; left: 0;')) }}
                                    </div>

                                @endif

                            @endforeach

                        </div>

                    </div>


                    @if( $products['customizable'] == '1' )

                        <div id="customize_div" style="margin: 30px 0 0 0;">
                            
                            <div class="form-group" style="margin: 0 -15px">
                                <div class="alert alert-info">
                                    <b>Product's Customizable Parts</b>
                                    <div class="pull-right">
                                        <a class="add_parts" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to add more parts."><i class="glyphicon glyphicon-plus"></i> Parts</a>
                                    </div>
                                </div>
                            </div>


                            @foreach( $products['parts'] as $part_id => $parts )
                                
                                @foreach( $parts as $part_name => $choices )

                                    <div id="customize_div">

                                        <div id="part_{{ $part_id }}">

                                            <div class="form-group" style="margin: 20px 0px">

                                                <div class="form-group" style="margin: 20px -15px">
                                                    <b>{{ $part_name }}</b> 
                                                    <div class="label_text pull-right">
                                                        [ <a id="add_new_choices" part_id="{{ $part_id }}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to add more choices."><i class="glyphicon glyphicon-plus"></i></a> ] 
                                                        {{ Form::checkbox('del_product_parts[]', $part_id, false) }}
                                                    </div>
                                                    <hr>
                                                </div>

                                                @foreach( $choices as $choice_id => $choice_attr )

                                                    <div style="position: relative; float: left; margin: 0 0 10px 10px;"> 
                                                        {{ HTML::image('choices_images/' . $choice_attr['filename'], '...', array('class' => 'img-thumbnail', 'width' => '100px')) }}
                                                        {{ Form::checkbox('del_choices[]', $choice_id, false, array('style' => 'position: absolute; left: 0;')) }}
                                                        <div class="text-center"><b>{{ $choice_attr['name'] }}</b></div>
                                                        <div class="text-center">Php {{ number_format($choice_attr['cost'], 2, '.', ',') }}</div>
                                                    </div>
                                                        
                                                @endforeach
                                                
                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            @endforeach

                        </div>

                    @endif

                </div>
            </div>

        {{ Form::close() }}

  


    </div>

@stop