<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Csv\Writer;

class OrderController extends Controller
{

    public function parseData() {

        //data/data1.csv'
        if(($handle = fopen(public_path() .  '/data/data1.csv', 'r')) !== FALSE) {
            // Skips first line in csv removing headers
            fgetcsv($handle);

            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE ) {
                $orders = new Order();

                $orders->name           = $data[0];
                $orders->order_date     = $data[1];
                $orders->sub_total      = $data[2];
                $orders->vat_percentage = $data[3];

                $vat_value = $data[2] * $data[3] / 100;
                $orders->vat_value = round($vat_value, 2);

                $total = $data[2] + $vat_value;
                $orders->total = $total;

                $orders->save();
            }

            fclose($handle);
        }

        //data/data2.csv'
        if(($handle = fopen(public_path() .  '/data/data2.csv', 'r')) !== FALSE) {
            // Skips first line in csv removing headers
            fgetcsv($handle);

            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE ) {
                $orders = new Order();

                $orders->name       = $data[0];
                $orders->order_date = $data[1];
                $orders->sub_total  = $data[2];
                $orders->total      = $data[3];

                $vat_value = $data[3] - $data[2];
                $orders->vat_value = round($vat_value, 2);

                $orders->save();
            }

            fclose($handle);
        }

        //XML data input
        $xml = simplexml_load_file(public_path() . '/data/data4.xml');

        foreach($xml->children() as $row) {
            $orders = new Order();
            $orders->name = $row->productName;
            $orders->order_date = $row->date;
            $orders->sub_total = $row->subtotal;
            $orders->vat_percentage = $row->vatRate;

            $vat_value = $row->subtotal * $row->vatRate / 100;
            $orders->vat_value = round($vat_value, 2);

            $total = $row->subtotal + $vat_value;
            $orders->total = $total;

            $orders->save();
        }

        //Json file import
        $json = file_get_contents(public_path() . '/data/data3.json');
        $objects = json_decode($json, true);

        foreach($objects['orders'] as $row) {
            $orders = new Order();
            $orders->name = $row['name'];
            $orders->order_date = $row['order_date'];
            $orders->sub_total = $row['subtotal'];
            $orders->vat_value = $row['vat'];

            $total = $row['subtotal'] + $row['vat'];
            $orders->total = $total;

            $orders->save();
        }
    }

    public function get() {
        $orders = Order::get();

        $data = [
            'status' => 200,
            'data'   => $orders
        ];

        return response($data);
    }

    public function export() {

        $header = ['id','order_date', 'name', 'sub total', 'vat_value', 'vat_percentage', 'total', 'created_at', 'updated_at'];


        $orders   = Order::all();
        $array = json_decode(json_encode($orders), true);

        $file = fopen(public_path(). '/data/orders.csv', 'w');

            fputcsv($file, $header);

            foreach ($array as $row) {
                fputcsv($file, $row);
            }

        fclose($file);

         return response()->download(public_path(). '/data/orders.csv', 'orders.csv');

    }
}
