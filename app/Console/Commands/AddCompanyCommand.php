<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';
//    protected $signature = 'contact:company {name} {phone?}';     //optional

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new Company';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is the company name?');
        $phone = $this->ask('What is the company phone?');

        if ($this->confirm('Are you ready to insert "' . $name . '"?'))
        {
            $company = Company::create([
                'name' => $name,
                'phone' => $phone,
            ]);

            return $this->info('Added: ' . $company->name);
        }

        $this->warn('No new company added.');

//        $this->info('Added: ' . $company->name);
    }
}
