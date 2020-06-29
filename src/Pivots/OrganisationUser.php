<?php

namespace PurpleMountain\Organisations\Pivots;

use App\Organisation;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use PurpleMountain\Helpers\Traits\HasUUID;
use PurpleMountain\Helpers\Traits\Responsable;

class OrganisationUser extends Pivot
{
    use HasUUID, Responsable;

    /**
     * The table that this pivot is associated with.
     *
     * @return boolean
     */
    public $table = 'organisation_user';

    /**
     * Whether the ID collumn in auto incrementing.
     *
     * @return boolean
     */
    public $incrementing = false;

    /**
     * What the ID collumn key type is.
     *
     * @return string
     */
    protected $keyType = 'string';

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['organisation', 'users'];

    /**
     * Get the extra columns on the pivot table.
     *
     * @return array
     */
    public static function columns(): array
    {
        return [
            'position'
        ];
    }

    /**
     * Which collumns to use for ordering.
     *
     * @return array
     */
    private function responsableOrderByAlias()
    {
        return [
            'id' => 'id',
            'created_at' => 'created_at'
        ];
    }

    /**
     * Which collumns to use for search.
     *
     * @return array
     */
    private function responsableSearch()
    {
        return [
            'id',
            'position'
        ];
    }

    /**
     * The user that this pivot is accociated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The organisation that this pivot is accociated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }
}
