<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\City;
use App\Models\Trip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::with(['city'])->get();

        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trips.create', compact('cities'));
    }

    public function store(StoreTripRequest $request)
    {
        $trip = Trip::create($request->all());

        return redirect()->route('admin.trips.index');
    }

    public function edit(Trip $trip)
    {
        abort_if(Gate::denies('trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trip->load('city');

        return view('admin.trips.edit', compact('cities', 'trip'));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->update($request->all());

        return redirect()->route('admin.trips.index');
    }

    public function show(Trip $trip)
    {
        abort_if(Gate::denies('trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->load('city', 'tripExpenses');

        return view('admin.trips.show', compact('trip'));
    }

    public function destroy(Trip $trip)
    {
        abort_if(Gate::denies('trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTripRequest $request)
    {
        Trip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
