<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPlanRequest;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use App\Models\Trip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $plans = Plan::with(['trip'])->get();

        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::pluck('starts_at', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.plans.create', compact('trips'));
    }

    public function store(StorePlanRequest $request)
    {
        $plan = Plan::create($request->all());

        return redirect()->route('admin.plans.index');
    }

    public function edit(Plan $plan)
    {
        abort_if(Gate::denies('plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::pluck('starts_at', 'id')->prepend(trans('global.pleaseSelect'), '');

        $plan->load('trip');

        return view('admin.plans.edit', compact('plan', 'trips'));
    }

    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->update($request->all());

        return redirect()->route('admin.plans.index');
    }

    public function show(Plan $plan)
    {
        abort_if(Gate::denies('plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $plan->load('trip');

        return view('admin.plans.show', compact('plan'));
    }

    public function destroy(Plan $plan)
    {
        abort_if(Gate::denies('plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $plan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanRequest $request)
    {
        Plan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
