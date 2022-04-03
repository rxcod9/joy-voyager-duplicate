<?php

namespace Joy\VoyagerDuplicate\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Duplicate extends Command
{
    protected $name = 'joy-duplicate';

    protected $description = 'Joy Voyager Duplicateer';

    public function handle()
    {
        $this->output->title('Starting duplicate');

        // Your magic here

        $this->output->success('Duplicate successful');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['arguement1', InputArgument::REQUIRED, 'The argument1 description'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'option1',
                'o',
                InputOption::VALUE_OPTIONAL,
                'The option1 description',
                config('joy-voyager-duplicate.option1')
            ],
        ];
    }
}
