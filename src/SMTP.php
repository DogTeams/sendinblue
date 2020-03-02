<?php

namespace Dogteam\Sendinblue;

use SendinBlue\Client\Api\SMTPApi;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;
use SendinBlue\Client\Model\CreateSmtpTemplate;
use SendinBlue\Client\Model\SendEmail;

class SMTP
{
    private $Api;

    public function __contruct(){
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key',env('SENDINBLUE_APIKEY'));
        $this->Api = new SMTPApi(new Client(), $config);
    }
    public function client(){
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key',env('SENDINBLUE_APIKEY'));
        return $this->Api = new SMTPApi(new Client(), $config);
    }
    public function create($type, $array){
        switch($type){
            case 'Template':
                $this->createTemplate($array);
            break;
            case 'TemplateAsync':
                $this->createTemplateAsync($array);
            break;
        }
    }
    public function update($type, $templateId, $array){
        switch($type){
            case 'Template':
                $this->updateTemplate($templateId, $array);
            break;
            case 'TemplateAsync':
                $this->updateTemplateAsync($templateId, $array);
            break;
        }
    }
    public function delete($type, $templateId = null, $deleteHardbounces = null){ //templateId non utile pour deleteHardbounces & deleteHardbouncesAsync
        switch($type){                                                            /*deleteHardbounces(optional)*/
            case 'Template':
                $this->Api->deleteSmtpTemplate($templateId);
            break;
            case 'TemplateAsync':
                $this->Api->deleteSmtpTemplateAsync($templateId);
            break;
            case 'deleteHardbounces':
                $this->Api->deleteSmtpHardbounces($deleteHardbounces);
            break;
            case 'deleteHardbouncesAsync':
                $this->Api->deleteSmtpHardbouncesAsync($deleteHardbounces);
            break;
        }
    }
    public function send($type,$array, $templateId = null){ //templateId non utile pour sendTransacEmail & sendTransecEmailAsync
        switch($type){
            case 'Template':
                $this->sendTemplate($templateId, $array);
            break;
            case 'TemplateAsync':
                $this->sendTemplateAsync($templateId, $array);
            break;
            case 'TestTemplate':
                $this->sendTestTemplate($templateId, $array);
            break;
            case 'TestTemplateAsync':
                $this->sendTestTemplateAsync($templateId, $array);
            break;
            case 'TransacEmail':
                $this->sendTransacEmail($array);
            break;
            case 'TransacEmailAsync':
                $this->sendTransecEmailAsync($array);
            break;
        }
    }
    public function getEmailReport(
        $type,
        $limit = '50', 
        $offset = '0',
        $startDate = null, 
        $endDate = null, 
        $days = null, 
        $email = null, 
        $event = null, 
        $tags = null, 
        $messageId = null, 
        $templateId = null
        ){
        switch($type){
            case 'EmailEventReport':
                return $this->Api->getEmailEventReport($limit, $offset, $startDate, $endDate, $days, $email, $event, $tags, $messageId, $templateId);
            break;
            case 'EmailEventReportAsync':
                return $this->Api->getEmailEventReportAsync($limit, $offset, $startDate, $endDate, $days, $email, $event, $tags, $messageId, $templateId);
            break;
        }
    }    
    public function getReport(
        $type,
        $limit = '50', 
        $offset = '0', 
        $startDate = null, 
        $endDate = null, 
        $days = null, 
        $tag = null
        ){
        switch($type){
            case 'Report':
                return $this->Api->getSmtpReport($limit, $offset, $startDate, $endDate, $days, $tag);
            break;
            case 'ReportAsync':
                return $this->Api->getSmtpReportAsync($limit, $offset, $startDate, $endDate, $days, $tag);
            break;
        }
    }  
    public function getAggreted(
        $type,
        $startDate = null, 
        $endDate = null, 
        $days = null, 
        $tag = null
        ){
        switch($type){
            case 'AggregatedSmtpReport':
                return $this->Api->getAggregatedSmtpReport($startDate, $endDate, $days, $tag);
            break;
            case 'AggregatedSmtpReportAsync':
                return $this->Api->getAggregatedSmtpReportAsync($startDate, $endDate, $days, $tag);
            break;
        }
    }
    public function getTemplate(
        $type,
        $templateId = null,
        $templateStatus = null,
        $limit = '50', 
        $offset = '0'
        ){
        switch($type){
            case 'Template':
                return $this->Api->getSmtpTemplate($templateId);
            break;
            case 'TemplateAsync':
                return $this->Api->getSmtpTemplateAsync($templateId);
            break;
            case 'Templates':
                return $this->Api->getSmtpTemplates($templateStatus, $limit, $offset);
            break;
            case 'TemplatesAsync':
                return $this->Api->getSmtpTemplateAsync($templateStatus, $limit, $offset);
            break;

        }
    }


    //Méthode Create
    public function createTemplate($array){
        $smtpTemplate = new CreateSmtpTemplate($array);
        $this->Api->createSmtpTemplate($smtpTemplate);
    }
    public function createTemplateAsync($array){
        $smtpTemplate = new CreateSmtpTemplate($array);
        return $this->Api->createSmtpTemplateAsync($smtpTemplate);
    }
    //Méthode Update
    public function updateTemplate($templateId, $array){
        $smtpTemplate = new CreateSmtpTemplate($array);
        return $this->Api->updateSmtpTemplate($templateId, $smtpTemplate);
    }
    public function updateTemplateAsync($array){
        $smtpTemplate = new CreateSmtpTemplate($array);
        return $this->Api->updateSmtpTemplateAsync($templateId, $smtpTemplate);
    }
    //Méthode Send
    public function sendTemplate($templateId, $array){
        $sendEmail = new SendEmail($array);
        return $this->Api->sendTemplate($templateId, $sendEmail);
    }
    public function sendTemplateAsync($templateId, $array){
        $sendEmail = new SendEmail($array);
        return $this->Api->sendTemplateAsync($templateId, $sendEmail);
    }
    public function sendTestTemplate($templateId, $array){
        $sendEmail = new SendEmail($array);
        return $this->Api->sendTestTemplate($templateId, $sendEmail);
    }
    public function sendTestTemplateAsync($templateId, $array){
        $sendEmail = new SendEmail($array);
        return $this->Api->sendTestTemplateAsync($templateId, $sendEmail);
    }
    public function sendTransacEmail($array){
        $sendTransacEmail = new SendSmtpEmail($array);
        return $this->Api->sendTransacEmail($templateId, $sendEmail);
    }
    public function sendTransacEmailAsync($array){
        $sendTransacEmail = new SendSmtpEmail($array);
        return $this->Api->sendTransacEmailAsync($templateId, $sendEmail);
    }
}
