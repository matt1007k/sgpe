<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $allowedSorts = ['created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dni', 'phone', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public const VALIDATION_RULES = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'dni' => ['required', 'string', 'digits_between:8,9', 'unique:users'],
        'phone' => ['required', 'numeric', 'digits_between:6,9'],
        'email' => ['required', 'email', 'max:255', 'unique:users'],
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function scopeSearch(Builder $query, $values)
    {
        if ($values == null) {
            return;
        }

        foreach (Str::of($values)->explode(' ') as $value) {
            $query->orWhere('name', 'LIKE', "%$value%")
                ->orWhere('dni', 'LIKE', "%$value%");
        }
    }

    public function scopeStatus(Builder $query, $value)
    {
        $query->where('status', $value);
    }

    public function sendMessageToAdmin()
    {
        $body = $this->getBodyMessageToAdmin();

        $this->messages()->create([
            'to' => 'admin@drea.com',
            'subject' => 'Activación de cuenta',
            'body' => $body,
        ]);
    }

    public function getBodyMessageToAdmin()
    {
        $url = $this->pathEdit();
        return <<<EOT
        Hola Administrador, me presento ante usted para solicitar la activación de mi cuenta de usuario. Para ingresar a ver mis boletas de pagos.

        Espero su disposición, cualquier aviso se me comunique a mi correo o num. de teléfono ingresado.

        **DNI** \t
        $this->dni

        **Correo electrónico**\t
        $this->email
                
        **Teléfono o celular**\t
        $this->phone

        [Verificar usuario]($url)

        Gracias por su atención,\t
        ##### $this->name
        EOT;
    }

    public function pathEdit()
    {
        return route('users.edit', $this);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
