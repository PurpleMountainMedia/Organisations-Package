<?php

namespace PurpleMountain\Organisations\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOrganisation
{
    /**
     * The organisation this model belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(config('organisation.organisation'));
    }
}