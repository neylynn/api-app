<?php

namespace App\Console\Commands;

use App\Models\API\Authorization;
use App\Models\API\ChargingPeriod;
use App\Models\API\LogData;
use App\Models\API\MeterValue;
use App\Models\API\Session;
use App\Models\API\Tax;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProcessLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:process-logs';
    protected $signature = 'process:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and process data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Make an API request to fetch the log data
        $response = Http::get('API_URL');
        $data = $response->json();

        if ($response->successful()) {
            $data = $response->json();

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
                    'socPercent' => $data['session']['socPercent'],
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
                    'socPercent' => $data['session']['socPercent'],
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
            $this->info('Log data processed and saved.');
        } else {
            $this->error('Failed to fetch log data from the API.');
        }
    }
}
