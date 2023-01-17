<?php

namespace Joy\VoyagerDuplicate\Http\Controllers;

use Joy\VoyagerDuplicate\Http\Traits\DuplicateAction;
use Joy\VoyagerCore\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    use DuplicateAction;
}
