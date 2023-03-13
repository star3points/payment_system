<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\BalanceResource
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount The value is indicated in conditional cents
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BalanceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereUserId($value)
 * @mixin \Eloquent
 */
class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
