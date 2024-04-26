<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{

    public function index()
    {
//        $this->authorize('viewAny', DeliveryMethod::class);

        return view('admin.settings.delivery-methods.index', [
            'delivery_methods' => DeliveryMethod::orderBy('pos')->get()
        ]);
    }

    public function show(DeliveryMethod $deliveryMethod)
    {
        return $deliveryMethod;
    }

    public function update(Request $request, DeliveryMethod $deliveryMethod)
    {
        $this->authorize('update', DeliveryMethod::class);

        if ($request->wantsJson()) {
            $result = $deliveryMethod->update([
                'is_active' => $request->post('is_active')
            ]);

            return [
                'result' => $result
            ];
        }

        $deliveryMethod->update($request->all());
        return back()->with('Изменения сохранено');
    }

    public function updatePositions(Request $request)
    {
        $this->authorize('update', DeliveryMethod::class);

        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = DeliveryMethod::findOrFail($position['id']);
                $model->pos = $position['position'];
                $model->save();
            }
        }
    }

    public function bulkChangeStatus(Request $request)
    {
        $this->authorize('update', DeliveryMethod::class);

        $ids = $request->ids;
        $status = $request->status;

        if (is_array($ids) && !empty($ids))
            DeliveryMethod::whereIn('id', $ids)->update([
                'is_active' => $status
            ]);
    }

    public function destroy(Request $request, DeliveryMethod $deliveryMethod)
    {
        if ($deliveryMethod->delete()) {
            return to_route('admin.delivery-methods.index')->with('success', 'Метод удален');
        }

        return back()->with('error', 'Не удалось удалить метод');
    }

}
