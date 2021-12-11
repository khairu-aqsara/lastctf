<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Breakme extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'breakme';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Break-Me Game For Fun';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $imagename = microtime(true);
        $this->info('Just want to know if you could break it or not.');
        $this->info('Have fun and try to break this for 150 times');
        $this->info('Once your answer is wrong your score willbe back to 0');
        if ($this->confirm('Do you wish to continue?')) {
            $num = 0;
            $this->newLine();
            while($num <= 150){
                $start = microtime(true);
                $image = $this->create_image($imagename);
                $this->info($image[1]);
                $gues = $this->ask('What is this ?');
                if($gues == $image[0]){
                    $time_elapsed_secs = microtime(true) - $start;
                    if($time_elapsed_secs > 5){
                        $this->error('To Slow Buddy.....');
                        $num = 0;
                    }else{
                        if($num == 150){
                            $this->info('Congrats Made it, as a promise, here is your flag...');
                            $this->newLine();
                            $this->info(file_get_contents('./flag'));
                            $this->newLine();
                            exit;
                        }
                        $this->info('Congrats You right, your score is '.$num.' keep going....');
                        $this->newLine();
                        $num++;
                    }
                }else{
                    $this->error('Try Harder Mas bro! your score is '.$num.'');
                    $this->newLine();
                    $num = 0;
                } 
            }
        }else{
            $this->error('Good Bye!');
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    public function create_image($imagename)
    {
        $image = \imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");
    
        $background_color = \imagecolorallocate($image, 255, 255, 255);
        $text_color = \imagecolorallocate($image, 72, 64, 161);
        $line_color = \imagecolorallocate($image, 54, 170, 171);
        $pixel_color = \imagecolorallocate($image, 255, 27, 0);
    
        \imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
    
        for ($i = 0; $i < 6; $i++) {
            \imagesetthickness($image, rand(1,3));
        }
    
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $len = strlen($letters);
        $letter = $letters[rand(0, $len - 1)];
       
        $word = "";
        for ($i = 0; $i < 5; $i++) {
            $letter = $letters[rand(0, $len - 1)];
            \imagestring($image, 5, 35 + ($i * 30), rand(5, 30), $letter, $text_color);
            $word .= $letter;
        }

        \imagepng($image, md5($imagename).'_image.png');
        $src = base64_encode(file_get_contents(md5($imagename).'_image.png'));
        \imagedestroy($image);
        @unlink(md5($imagename).'_image.png');
        return [ $word, $src];
    }
}
