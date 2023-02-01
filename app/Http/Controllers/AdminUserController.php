<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    public function index() {
        return view('admin.users.index', [
            'users' => User::orderBy('lastName')->paginate(50)
        ]);
    }

    public function activate(User $user) {
        $user->isActive = true;

        $user->save();

        $to_name = $user->firstName . ' ' . $user->lastName;
        $to_email = $user->email;
        $data = array('name'=>$to_name, 'body' => 'Il tuo account è ora attivo!');

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Utenza attivata!');
            $message->from(env('MAIL_FROM_ADDRESS'),'Test Mail');
        });

        return redirect('/admin/users')->with('success', 'Utente attivato!');
    }

    public function deactivate(User $user) {
        $user->isActive = false;

        $user->save();

        $to_name = $user->firstName . ' ' . $user->lastName;
        $to_email = $user->email;
        $data = array('name'=>$to_name, 'body' => 'Il tuo account è ora disattivo!');

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Utenza disattivata');
            $message->from(env('MAIL_FROM_ADDRESS'),'Test Mail');
        });

        return redirect('/admin/users')->with('success', 'Utente disattivato!');
    }

    public function admin_activate(User $user) {
        $user->isAdmin = true;

        $user->save();

        return redirect('/admin/users')->with('success', 'Utente promosso ad admin!');
    }

    public function admin_deactivate(User $user) {
        $user->isAdmin = false;

        $user->save();

        return redirect('/admin/users')->with('success', 'Admin retrocesso ad utente!');
    }

    public function destroy(User $user) {
        $user->delete();

        return back()->with('success', 'Utente Eliminato!');
    }

    public function passwordReset(User $user){

        $password = $this->generatePassword(10);
        $user->password = $password;

        $user->save();

        $to_name = $user->firstName . ' ' . $user->lastName;
        $to_email = $user->email;
        $data = array('name'=>$to_name, 'body' => 'La tua password è stata ripristinata! La tua nuova password è:<br><strong>'. $password .'</strong>');

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Password ripristinata!');
            $message->from(env('MAIL_FROM_ADDRESS'),'Test Mail');
        });

        return back()->with('success', 'Password ripristinata!');
    }

    protected function generatePassword($length) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
    }
}
