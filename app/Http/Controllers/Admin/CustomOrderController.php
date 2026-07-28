<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomOrder::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%');
            });
        }

        $customOrders = $query->paginate(15)->withQueryString();
        $statuses = [
            CustomOrder::STATUS_NOUVEAU, CustomOrder::STATUS_CONTACTE,
            CustomOrder::STATUS_TERMINE, CustomOrder::STATUS_ANNULE,
        ];

        return view('admin.custom_orders.index', compact('customOrders', 'statuses'));
    }

    public function show(CustomOrder $customOrder)
    {
        return view('admin.custom_orders.show', compact('customOrder'));
    }

    public function updateStatus(Request $request, CustomOrder $customOrder)
    {
        $request->validate(['status' => 'required|string']);
        $customOrder->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Statut mis à jour !');
    }

    public function destroy(CustomOrder $customOrder)
    {
        if ($customOrder->photo) {
            delete_image_from_db($customOrder->photo);
        }
        $customOrder->delete();

        return redirect()->route('admin.custom-orders.index')->with('success', 'Demande supprimée.');
    }
}
