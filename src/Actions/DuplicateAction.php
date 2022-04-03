<?php

namespace Joy\VoyagerDuplicate\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use TCG\Voyager\Actions\AbstractAction;
use TCG\Voyager\Facades\Voyager;

class DuplicateAction extends AbstractAction
{
    public function getTitle()
    {
        return __('joy-voyager-duplicate::generic.duplicate');
    }

    public function getIcon()
    {
        return 'voyager-duplicate';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'id'     => 'duplicate_btn',
            'class'  => 'btn btn-primary',
            'target' => '_blank',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('my.route');
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

    public function massAction($ids, $comingFrom)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug(request());

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Gate::authorize('browse', app($dataType->model_name));

        // Your macgic here

        return redirect()->back()->with([
            'message'    => __('joy-voyager-duplicate::generic.successfully_duplicateed') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
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
