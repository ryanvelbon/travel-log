<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipRequest;
use App\Http\Requests\StoreTipRequest;
use App\Http\Requests\UpdateTipRequest;
use App\Models\Country;
use App\Models\Tip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tips = Tip::with(['countries'])->get();

        return view('admin.tips.index', compact('tips'));
    }

    public function create()
    {
        abort_if(Gate::denies('tip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id');

        return view('admin.tips.create', compact('countries'));
    }

    public function store(StoreTipRequest $request)
    {
        $tip = Tip::create($request->all());
        $tip->countries()->sync($request->input('countries', []));

        return redirect()->route('admin.tips.index');
    }

    public function edit(Tip $tip)
    {
        abort_if(Gate::denies('tip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id');

        $tip->load('countries');

        return view('admin.tips.edit', compact('countries', 'tip'));
    }

    public function update(UpdateTipRequest $request, Tip $tip)
    {
        $tip->update($request->all());
        $tip->countries()->sync($request->input('countries', []));

        return redirect()->route('admin.tips.index');
    }

    public function show(Tip $tip)
    {
        abort_if(Gate::denies('tip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tip->load('countries');

        return view('admin.tips.show', compact('tip'));
    }

    public function destroy(Tip $tip)
    {
        abort_if(Gate::denies('tip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipRequest $request)
    {
        Tip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
