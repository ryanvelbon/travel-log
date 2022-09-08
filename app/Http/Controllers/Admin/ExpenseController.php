<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Trip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = Expense::with(['trip'])->get();

        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::pluck('starts_at', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expenses.create', compact('trips'));
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());

        return redirect()->route('admin.expenses.index');
    }

    public function edit(Expense $expense)
    {
        abort_if(Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::pluck('starts_at', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expense->load('trip');

        return view('admin.expenses.edit', compact('expense', 'trips'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        return redirect()->route('admin.expenses.index');
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->load('trip');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        Expense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
