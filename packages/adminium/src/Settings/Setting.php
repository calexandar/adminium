<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Settings;

use Illuminate\Database\Eloquent\Model;

final class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];
}
