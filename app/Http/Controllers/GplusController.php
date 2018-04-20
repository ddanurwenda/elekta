<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gplus\Emil;
use App\Models\Gplus\Khofifah;
use App\Models\Gplus\Puti;
use App\Models\Gplus\Ipul;

class GplusController extends Controller {

    public function getIndex() {
        return view('pages.sosmed.gplus');
    }

    public static function getToday($id) {
        $today = \Carbon\Carbon::today(config('app.timezone'));
        $tomorrow = \Carbon\Carbon::tomorrow(config('app.timezone'));
        switch ($id) {
            case 1:
                $today = Khofifah::whereBetween('published', [$today, $tomorrow])->get()->count();
                break;
            case 2:
                $today = Emil::whereBetween('published', [$today, $tomorrow])->get()->count();
                break;
            case 3:
                $today = Ipul::whereBetween('published', [$today, $tomorrow])->get()->count();
                break;
            case 4:
                $today = Puti::whereBetween('published', [$today, $tomorrow])->get()->count();
                break;
        }


        return $today;
    }

    private static function getWeekAggregation($collection) {
        $tomorrow = \Carbon\Carbon::tomorrow(config('app.timezone'));
        $sixDaysAgo = \Carbon\Carbon::tomorrow(config('app.timezone'))->subWeek();
        return $collection->aggregate([
                    [
                        '$match' => [
                            'published' => [
                                '$gte' => new \MongoDB\BSON\UTCDateTime(1000 * $sixDaysAgo->getTimestamp())
                                , '$lt' => new \MongoDB\BSON\UTCDateTime(1000 * $tomorrow->getTimestamp())
                            ]
                        ]
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'date' => ['$dateToString' => ['timezone' => config('app.timezone'), 'format' => "%Y-%m-%d", 'date' => '$published']]
                            ],
                            'sum' => ['$sum' => 1]
                        ]
                    ]
        ]);
    }

    public static function getWeeks() {
        $datakhof = Khofifah::raw(function($collection) {
                    return GplusController::getWeekAggregation($collection);
                });
        $dataipul = Ipul::raw(function($collection) {
                    return GplusController::getWeekAggregation($collection);
                });
        $dataemil = Emil::raw(function($collection) {
                    return GplusController::getWeekAggregation($collection);
                });
        $dataputi = Puti::raw(function($collection) {
                    return GplusController::getWeekAggregation($collection);
                });

        $array = [];
        for ($i = 6; $i >= 0; $i--) {
            $new = [];
            $new['date'] = \Carbon\Carbon::now(config('app.timezone'))->subDays($i)->toDateString();
            $new['khofifah'] = 0;
            $new['ipul'] = 0;
            $new['emil'] = 0;
            $new['puti'] = 0;

            foreach ($datakhof as $data) {

                if ($data['_id.date'] == $new['date']) {
                    $new['khofifah'] += $data['sum'];
                    break;
                }
            }

            foreach ($dataipul as $data) {

                if ($data['_id.date'] == $new['date']) {
                    $new['ipul'] += $data['sum'];
                    break;
                }
            }

            foreach ($dataemil as $data) {

                if ($data['_id.date'] == $new['date']) {
                    $new['emil'] += $data['sum'];
                    break;
                }
            }

            foreach ($dataputi as $data) {

                if ($data['_id.date'] == $new['date']) {
                    $new['puti'] += $data['sum'];
                    break;
                }
            }

            array_push($array, $new);
        }


        return json_encode($array);
    }

    private static function userCountAggregate($col, $start, $end) {
        return $col->aggregate([
                    [
                        '$match' => [
                            'published' => [
                                '$gte' => new \MongoDB\BSON\UTCDateTime(1000 * $start->getTimestamp())
                                , '$lt' => new \MongoDB\BSON\UTCDateTime(1000 * $end->getTimestamp())
                            ]
                        ]
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'user' => '$actor.displayName'
                            ],
                            'count' => ['$sum' => 1]
                        ]
                    ],
                    [
                        '$sort' => ['count' => -1]
                    ]
        ]);
    }

    public static function getUserCount($id) {
        $today = \Carbon\Carbon::today(config('app.timezone'));
        $tomorrow = \Carbon\Carbon::tomorrow(config('app.timezone'));
        switch ($id) {
            case 1:
                $json = Khofifah::raw(function($collection) use ($today, $tomorrow) {
                            return GplusController::userCountAggregate($collection, $today, $tomorrow);
                        });
                break;
            case 2:
                $json = Emil::raw(function($collection) use ($today, $tomorrow) {
                            return GplusController::userCountAggregate($collection, $today, $tomorrow);
                        });
                break;
            case 3:
                $json = Ipul::raw(function($collection) use ($today, $tomorrow) {
                            return GplusController::userCountAggregate($collection, $today, $tomorrow);
                        });
                break;
            case 4:
                $json = Puti::raw(function($collection) use ($today, $tomorrow) {
                            return GplusController::userCountAggregate($collection, $today, $tomorrow);
                        });
                break;
        }
        $data2 = [];
        foreach ($json as $data) {
            $new = [];
            $new['username'] = $data['_id']['user'];
            $new['count'] = $data['count'];
            array_push($data2, $new);
        }
        return json_encode($data2);
    }

}
