@php
	$path = asset('attachments/'.$file->file_name);

	return Response::make(file_get_contents($path), 200, [
		'Content-Type' => 'application/pdf',
		'Content-Disposition' => 'inline; filename="'.$filename.'"'
	]);
@endphp