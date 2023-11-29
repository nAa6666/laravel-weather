<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class WeatherApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:weather {--city=Kyiv} {--country=UA}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Weather API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncWeather();
    }

    public function syncWeather()
    {
        $client = new Client();
        try {
            $res = $client->get('http://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'q' => sprintf('%s, %s', $this->option('city'), $this->option('country')),
                    'appid' => 'a2c2a155ae248399e4c8dba968869393',
                ]
            ])->getBody()->getContents();

            $res = json_decode($res, true);

            $table = new Table($this->output);
            $table->setHeaders([
                '<fg=black>Name</>', '<fg=black>Value</>'
            ]);

            $data = [];
            foreach ($res as $key=>$items){
                if ($key == 'coord' || $key == 'main') {
                    foreach ($items as $k=>$value){
                        if (in_array($k, ['temp', 'temp_min', 'temp_max', 'feels_like'])) {
                            $value = $value - 273.15;
                        }
                        $data[] = [$k, $value];
                    }
                }
            }

            $table->setRows($data);
            $table->render();
        }catch (\Exception $e) {
            $this->info($e->getMessage());
        }
    }
}
