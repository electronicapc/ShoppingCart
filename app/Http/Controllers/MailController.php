<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
	public function sendcom(Request $request)
	{
		$data = $request->all();
		\Mail::send('emails.compra', $data, function($message) use ($request)
		{
			//$message->from($request->email, $request->name);
			$message->from('electronicapcolombia@gmail.com');
			$message->subject('Nueva compra sitio Web');
			$message->to('electronicapcolombia@gmail.com');
			//$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
	
		});
		return \View::make('success');
		
		
		
	}
}
