<?php

namespace App\Repository;
use App\Models\PurchaseOrderSkds;
use Illuminate\Support\Facades\DB;

use App\Models\Shipment;
use App\Models\PurchaseOrder;
use App\Models\ShipmentSkd;
use App\Models\ShipmentStatusHistory;
use Mockery\Exception;

class PurchaseOrderRepository
{
    public function index($request)
    {
        return PurchaseOrder::when(isset($request->search), function ($query) use ($request) {
            $query->where('invoice_id', 'like', '%' . $request->search . '%')
                ->orWhere('supplier_id', 'like', '%' . $request->search . '%');
        })
            ->when(isset($request->sort_by), function ($query) use ($request) {
                $query->orderBy($request->sort_by);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->with(['supplier', 'purchaseOrdersSkds.skd', 'shipments.shipmentSkds.skd', 'shipmentHistories'])
            ->paginate($request->limit ?? 10);
    }

    public function findById($id)
    {
        return PurchaseOrder::findOrFail($id);
    }

    public function purchaseOrderSkds($id)
    {
        return PurchaseOrder::with('shipments.shipmentSkds')->find($id);
    }
    public function show($id)
    {
        return PurchaseOrder::with(['supplier', 'purchaseOrdersSkds.skd', 'shipments.shipmentSkds.skd', 'shipmentHistories'])->findOrFail($id);
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
            $pdf_path = isset($request['invoice_image']) ? uploadImage($request['invoice_image'], 'invoice') : "";

            $request['invoice_image'] = $pdf_path;
            $purchaseOrder = PurchaseOrder::create($request);

            $shipment = $purchaseOrder->shipments()->create([
                'shipment_name' => $request['shipment_name']
            ]);

            $newSkd = [];
            foreach ($request['skds'] as $skd)
            {
                $newSkd[] = ["received_qty" => 0, "required_qty" => $skd['quantity'], "price" => $request['price'], "skd_id" => $skd['skd_id']];
            }
            $shipment->shipmentSkds()->createMany($newSkd);


            $purchaseOrder->purchaseOrdersSkds()->createMany($request['skds']);

            ShipmentStatusHistory::create([
                "status_name" => "pending",
                "shipment_id" => $shipment->id,
            ]);


            DB::commit();
            return $purchaseOrder;
        }catch (Exception $exception){
            DB::rollBack();
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $purchaseOrder = PurchaseOrder::findOrFail($id);

            $pdf_path = isset($request['invoice_image']) ? uploadImage($request['invoice_image'], 'invoice') : $purchaseOrder->invoice_image;

            $request['invoice_image'] = $pdf_path;
            $purchaseOrder->update($request);

            // update shipment info
            $shipment = Shipment::where('purchase_order_id', $id)->first();
            $shipment->shipment_name = $request['shipment_name'];
            $shipment->save();

            // update shipment skds
            $shipment->shipmentSkds()->delete();

            $newSkd = [];
            foreach ($request['skds'] as $skd)
            {
                $newSkd[] = ["received_qty" => 0, "required_qty" => $skd['quantity'], "price" => $request['price'], "skd_id" => $skd['skd_id']];
            }
            $shipment->shipmentSkds()->createMany($newSkd);

            $purchaseOrder->purchaseOrdersSkds()->delete();
            $purchaseOrder->purchaseOrdersSkds()->createMany($request['skds']);
            DB::commit();
            return $purchaseOrder;
        }catch (Exception $exception){
            DB::rollBack();
        }
    }

    public function cancel($id)
    {
        return PurchaseOrder::findOrFail($id)->update(['status'=>'cancel']);
    }
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        removeImage($purchaseOrder->invoice_image);
        return $purchaseOrder->delete();
    }
}
