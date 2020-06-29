<?php

namespace PurpleMountain\Organisations\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PurpleMountain\Helpers\Models\BaseModel;
use PurpleMountain\Helpers\Traits\Responsable;
use PurpleMountain\Helpers\Traits\WasCreatedBy;
use PurpleMountain\Organisations\Pivots\OrganisationUser;

class Organisation extends BaseModel
{
    use Responsable, WasCreatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ref', 'created_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        //
    ];

    /**
     * Which collumns to use for ordering.
     *
     * @return array
     */
    private function responsableOrderByAlias()
    {
        return [
            'id' => 'id',
            'name' => 'name',
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
            'name'
        ];
    }

    /**
     * The users within this organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->hasMany(User::class)
            ->using(OrganisationUser::class)
            ->withPivot(OrganisationUser::columns())
            ->withTimestamps();
    }
}
