<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonCollection;
use Illuminate\Notifications\Action;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::applyFilters()->applySorts()
            ->jsonPaginate();

        return PersonCollection::make($people);
    }

    public function show(Person $person)
    {
        return PersonResource::make($person);
    }
}
