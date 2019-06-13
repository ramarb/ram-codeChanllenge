<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TransformHtml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transform:html {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $string = 'The "wp-content \'wp-content fox "wp-json jumps over the lazy dog \'wp-includes.';
        $patterns = array();
        $patterns[0] = '/\"wp-content/';
        $patterns[1] = '/\'wp-content/';
        $patterns[2] = '/\'wp-includes/';
        $patterns[3] = '/\"wp-json/';
        $patterns[4] = '/\"..\/wp-content/';
        $patterns[5] = '/\'..\/wp-content/';
        $patterns[6] = '/\'..\/wp-includes/';
        $patterns[7] = '/\"..\/wp-json/';
        $patterns[8] = '/\"..\/..\/wp-content/';
        $patterns[9] = '/\'..\/..\/wp-content/';
        $patterns[10] = '/\'..\/..\/wp-includes/';
        $patterns[11] = '/\"..\/..\/wp-json/';
        $replacements = array();
        $replacements[11] = '"/assets/theme1/wp-content';
        $replacements[10] = '\'/assets/theme1/wp-content';
        $replacements[9] = '\'/assets/theme1/wp-includes';
        $replacements[8] = '"/assets/theme1/wp-json';
        $replacements[7] = '"/assets/theme1/wp-content';
        $replacements[6] = '\'/assets/theme1/wp-content';
        $replacements[5] = '\'/assets/theme1/wp-includes';
        $replacements[4] = '"/assets/theme1/wp-json';
        $replacements[3] = '"/assets/theme1/wp-content';
        $replacements[2] = '\'/assets/theme1/wp-content';
        $replacements[1] = '\'/assets/theme1/wp-includes';
        $replacements[0] = '"/assets/theme1/wp-json';

        $path = $this->argument('path');

        $source = base_path($path);

        /*$this->info($string);
        $this->info(preg_replace($patterns, $replacements, $string));
        $this->info($this->argument('path'));

        $this->info($source);*/

        if(is_file($source)){
            $file_content = file_get_contents($source);

            foreach (explode("\r\n",$file_content) as $line){
                $this->info(preg_replace($patterns, $replacements, $line));
            }

        }else{
            $this->info('file not found');
        }

    }
}
