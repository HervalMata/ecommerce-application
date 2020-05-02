<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * @var string[][]
     */
    protected $settings = [
        [
            'key'   =>   'site_name',
            'value' =>   'Laços da Cris',
        ],
        [
            'key'   =>   'site_title',
            'value' =>   'CrisLaços',
        ],
        [
            'key'   =>   'default_email_address',
            'value' =>   'admin@admin.com',
        ],
        [
            'key'   =>   'currency_code',
            'value' =>   'REAL',
        ],
        [
            'key'   =>   'currency_symbol',
            'value' =>   'R$',
        ],
        [
            'key'   =>   'site_logo',
            'value' =>   '',
        ],
        [
            'key'   =>   'site_favicon',
            'value' =>   '',
        ],
        [
            'key'   =>   'footer_copyright_text',
            'value' =>   '',
        ],
        [
            'key'   =>   'seo_meta_title',
            'value' =>   '',
        ],
        [
            'key'   =>   'seo_meta_description',
            'value' =>   '',
        ],
        [
            'key'   =>   'social_facebook',
            'value' =>   '',
        ],
        [
            'key'   =>   'social_twitter',
            'value' =>   '',
        ],
        [
            'key'   =>   'social_instagram',
            'value' =>   '',
        ],
        [
            'key'   =>   'social_linkedin',
            'value' =>   '',
        ],
        [
            'key'   =>   'google_analytics',
            'value' =>   '',
        ],
        [
            'key'   =>   'facebook_pixels',
            'value' =>   '',
        ],
        [
            'key'   =>   'strype_payment_method',
            'value' =>   '',
        ],
        [
            'key'   =>   'strype_key',
            'value' =>   '',
        ],
        [
            'key'   =>   'strype_secret_key',
            'value' =>   '',
        ],
        [
            'key'   =>   'paypal_payment_method',
            'value' =>   '',
        ],
        [
            'key'   =>   'paypal_client_id',
            'value' =>   '',
        ],
        [
            'key'   =>   'paypal_secret_id',
            'value' =>   '',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting)
        {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index");
                return;
            }
        }
        $this->command->info('Inserted' . count($this->settings). ' records');
    }
}
