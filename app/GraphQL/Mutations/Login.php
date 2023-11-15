<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


final readonly class Login
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        if (!Auth::attempt(['email' => $args['email'], 'password' => $args['password']])) {
            return 'Credentials do not match';
        };

        $user = User::where('email', $args['email'])->first();

        return $user->createToken($user->name . 'API Token')->plainTextToken;
    }
}
