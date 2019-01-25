<?php

namespace Api\Link;

use App\Models\User;
use App\Exceptions\LinkNotFound;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }

    /**
     * @param $id
     */
    public function activateLink($id)
    {
        $user = User::find($id);
        $link = $user->referralLink;

        if ($link) {
            $link->active = true;
            $link->save();
            return response()->json(['message' => 'User : '.$user->name.', Link Activated!']);
        } else {
            throw new LinkNotFound;
        }
    }

    /**
     * @param $id
     */
    public function deactivateLink($id)
    {
        $user = User::find($id);
        $link = $user->referralLink;

        if ($link) {
            $link->active = false;
            $link->save();
            return response()->json(['message' => 'User : '.$user->name.' Link Deactivated!']);
        } else {
            throw new LinkNotFound;
        }
    }
}
