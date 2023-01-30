<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Validation\Rule;

    class RegisterController extends Controller {
        public function create() {
            return view('register.create');
        }

        public function store() {
            $attributes = request()->validate([
                'firstName' => ['required', 'max:255'],
                'lastName' => ['required', 'max:255'],
                'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
                'password' => ['required', 'min:7', 'max:255']
            ]);

            $user = User::create($attributes);

            $to_name = $user->firstName . ' ' . $user->lastName;
            $to_email = $user->email;
            $data = array('name'=>$to_name, 'body' => 'Hai creato il tuo account! Attendi la mail che conferma l\'attivazione prima di loggarti');

            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Account creato!');
                $message->from(env('MAIL_FROM_ADDRESS'),'Test Mail');
            });

            return redirect('/')->with('success', 'Account creato! Attendi conferma dell\'amministratore prima di usarlo!');
        }
    }
