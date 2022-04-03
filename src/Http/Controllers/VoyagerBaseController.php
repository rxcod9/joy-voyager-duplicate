<?php

namespace Joy\VoyagerDuplicate\Http\Controllers;

use Joy\VoyagerDuplicate\Http\Traits\DuplicateAction;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as TCGVoyagerBaseController;

class VoyagerBaseController extends TCGVoyagerBaseController
{
    use DuplicateAction;
}
