<div class="wrapper container-fluid">
{!! Form::open(['url' => route('servicesEdit',array('page'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
    	{!! Form::hidden('id', $data['id']) !!}
	     {!! Form::label('name', 'Название:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('name', $data['name'], ['class' => 'form-control','placeholder'=>'Введите название сервиса']) !!}
		 </div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('icon', 'Иконка:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
	     	<select class="selectpicker show-tick" name="icon">
	     		@foreach($optionList as $key => $value)
	     			@if ($data['icon'] == $value)
					    <option value="{{$value}}" data-content="<i class='fa {{$value}} serv_icon'></i>" selected>{{$key}}</option>
					@else
					    <option value="{{$value}}" data-content="<i class='fa {{$value}} serv_icon'></i>" >{{$key}}</option>
					@endif					
	     		@endforeach				
			</select> 
		 </div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::textarea('text', $data['text'], ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите описание сервиса']) !!}
		 </div>
    </div>
    
    
    

    
      <div class="form-group">
	    <div class="col-xs-offset-2 col-xs-10">
	      {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
	    </div>
	  </div>
    
{!! Form::close() !!}

 <script>
	CKEDITOR.replace( 'editor' );
</script>
</div>