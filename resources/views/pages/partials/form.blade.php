		<div class = "form group">
			{!! Form::label('nhi_and_ward', 'NHI: ') !!}
 			{!! Form::text ('nhi_and_ward', null,array('autofocus' => 'autofocus','class' => 'form control')) !!}
 		</div>
		<div class="form-group">
    		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
		</div>
 		