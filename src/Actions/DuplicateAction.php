<?php

namespace Joy\VoyagerDuplicate\Actions;

use Illuminate\Http\Request;
use TCG\Voyager\Actions\AbstractAction;

class DuplicateAction extends AbstractAction
{
    public function getTitle()
    {
        return __('joy-voyager-duplicate::generic.duplicate');
    }

    public function getIcon()
    {
        return 'fa-solid fa-clone';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right duplicate',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.' . $this->dataType->slug . '.duplicate', $this->data->{$this->data->getKeyName()});
    }

    public function shouldActionDisplayOnDataType()
    {
        return config('joy-voyager-duplicate.enabled', true) !== false
            && isInPatterns(
                $this->dataType->slug,
                config('joy-voyager-duplicate.allowed_slugs', ['*'])
            )
            && !isInPatterns(
                $this->dataType->slug,
                config('joy-voyager-duplicate.not_allowed_slugs', [])
            );
    }

    protected function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[1];
        }

        return $slug;
    }
}
