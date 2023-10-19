<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Authorization;
use App\Models\API\ChargingPeriod;
use App\Models\API\LogData;
use App\Models\API\MeterValue;
use App\Models\API\Session;
use App\Models\API\Tax;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class SaveLogController extends Controller
{
    public function processLogs(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if($data['notification'] == 'SessionMeterValuesNotification') {
            $log = LogData::create([
                'notification' => $data['notification'],
                'evseId' => $data['evseId'],
                'externalSessionId' => $data['externalSessionId'],
                'sessionId' => $data['sessionId'],
                'chargePointId' => $data['chargePointId'],
            ]);
    
            foreach ($data['meterValues'] as $meterValueData) {
                MeterValue::create([
                    'log_id' => $log->id,
                    'unit' => $meterValueData['unit'],
                    'measurand' => $meterValueData['measurand'],
                    'value' => $meterValueData['value'],
                    'timestamp' => $meterValueData['timestamp'],
                ]);
            }
        }else {

            $log = LogData::create([
                'notification' => $data['notification'],
            ]);

            $session = Session::create([
                'log_id' => $log->id,
                'socPercent' => $data['session']['socPercent'] ?? null,
                'extendingSessionId' => $data['session']['extendingSessionId'],
                'lastUpdatedAt' => $data['session']['lastUpdatedAt'],
                'nonBillableEnergy' => $data['session']['nonBillableEnergy'],
                'connectorId' => $data['session']['connectorId'],
                'authorizationId' => $data['session']['authorizationId'],
                'startedAt' => $data['session']['startedAt'],
                'idTag' => $data['session']['idTag'],
                'externalSessionId' => $data['session']['externalSessionId'],
                'terminalId' => $data['session']['terminalId'],
                'paymentType' => $data['session']['paymentType'],
                'tariffSnapshotId' => $data['session']['tariffSnapshotId'],
                'paymentMethodId' => $data['session']['paymentMethodId'],
                'currency' => $data['session']['currency'],
                'sessionId' => $data['session']['id'],
                'chargePointId' => $data['session']['chargePointId'],
                'paymentStatus' => $data['session']['paymentStatus'],
                'energy' => $data['session']['energy'],
                'amount' => $data['session']['amount'],
                'paymentStatusUpdatedAt' => $data['session']['paymentStatusUpdatedAt'],
                'evsePhysicalReference' => $data['session']['evsePhysicalReference'],
                'idTagLabel' => $data['session']['idTagLabel'],
                'userId' => $data['session']['userId'],
                'evseId' => $data['session']['evseId'],
                'powerKw' => $data['session']['powerKw'],
                'stoppedAt' => $data['session']['stoppedAt'],
                'electricityCost' => $data['session']['electricityCost'],
                'reimbursementEligibility' => $data['session']['reimbursementEligibility'],
                'status' => $data['session']['status'],
            ]);

            Authorization::create([
                'sessionId' => $session->id,
                'createdAt' => $data['session']['authorization']['createdAt'],
                'method' => $data['session']['authorization']['method'],
                'rfidTagUid' => $data['session']['authorization']['rfidTagUid'],
                'lastUpdatedAt' => $data['session']['authorization']['lastUpdatedAt'],
                'source' => $data['session']['authorization']['source'],
                'rejectionReason' => $data['session']['authorization']['rejectionReason'],
                'userId' => $data['session']['authorization']['userId'],
                'status' => $data['session']['authorization']['status'],
            ]);

            Tax::create([
                'sessionId' => $session->id,
                'taxId' => $data['session']['tax']['taxId'],
                'taxPercentage' => $data['session']['tax']['taxPercentage'],
            ]);

            ChargingPeriod::create([
                'sessionId' => $session->id,
                'amount' => $data['session']['chargingPeriods'][0]['amount'],
                'stoppedAt' => $data['session']['chargingPeriods'][0]['stoppedAt'],
                'startedAt' => $data['session']['chargingPeriods'][0]['startedAt'],
                'state' => $data['session']['chargingPeriods'][0]['state'],
                'energy' => $data['session']['chargingPeriods'][0]['energy'],
            ]);
        }

        return response()->json(['message' => 'Logs processed successfully'], 200);
    }
}
