<?php

namespace App\Component;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    protected $configName;
    protected $templateConfig;
    protected $contentPath;
    protected $dataSubject;
    protected $dataBody;
    protected $toEmail;
    protected $toName;

    public function __construct()
    {
        $this->templateConfig = config('emailTemplate.list.' . $this->configName);
        $this->contentPath = $this->templateConfig['content_path'];
        $templateParams = array_fill_keys(array_keys($this->templateConfig['variables']), '');
        foreach ($templateParams as $K => $V) {
            $this->dataSubject['{{$' . $K . '}}'] = '';
            $this->dataBody[$K] = '';
        }
    }
    
    public function setData($key, $value)
    {
        $this->dataSubject['{{$' . $key . '}}'] = $value;
        $this->dataBody[$key] = $value;
    }

    public function build()
    {
        $this->subject(str_replace(array_keys($this->dataSubject), array_values($this->dataSubject), $this->templateConfig['subject']));
        $this->from($this->templateConfig['email_from']);
        $this->to($this->toEmail, $this->toName);
        return $this->view('mail.' . $this->contentPath)->with($this->dataBody);
    }
}
