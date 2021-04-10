<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Usuario
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UsuarioFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUsername($value)
 * @mixin \Eloquent
 */
class Usuario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['username', 'password', 'token'];
}
