<?php

namespace App\Services;

use \App\Email;
use Illuminate\Support\Facades\DB;

/**
 * Class EmailService
 * @package App\Services
 */
class EmailService
{
    /**
     * used to set created/updated_at
     */
    const DATE_INPUT_FORMAT = 'Y-m-d H:i:s';

    /**
     * Return an Email object for the given $email address
     * @param string $email
     * @return Email
     */
    public function retrieveByEmail($email)
    {
        // let's not use findOrFail as we want to call it from different contexts
        return DB::table('emails')->where(['email' => $email])->first();
    }

    /**
     * Create and save an Email based on $data
     * @param array $data
     * @return Email
     */
    public function create(array $data): Email
    {
        // ensure the column will be set
        $data['created_at'] = date(self::DATE_INPUT_FORMAT);
        // Create the new post model
        return Email::create($data);
    }

}
