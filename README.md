SendinBlue 
===

Installation via Composer:
===
`composer require dogteam/sendinblue`

Configuration:
===
Ajouter les champs suivant dans votre fichier `.env`
`SENDINBLUE_APIKEY`: La clé qui permet de communiquer avec l'api

Utilisation:
===
Exemple:
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dogteam\Sendinblue\SMTP;

class Test extends Controller
{
    public function test(){

        $t = new SMTP();

        $template = [
            "templateName" => "My Template",
            "subject" => "test",
            "isActive" => false,
            "testSent" => false,
            "sender" => [
                'name' => 'Moi',
                'email' => 'mon@mail.com'
            ],
            "replyTo" => "[DEFAULT_REPLY_TO]",
            "toField" => "test",
            "tag" => "test",
            "htmlContent" => "Le contenu doit faire minimum 10 charactére"
        ];

        $fromto = [
            "Test@gmail.com",
            "test@test.com"
        ];
        
        $t->client();

        //La méthode create(). Vous avez le choix entre Template ou TemplateAsync
        $t->create('Template', $template);
        $t->create('TemplateAsync', $template);

        //La méthode update(). Vous avez le choix entre Template ou TemplateAsync
        $t->update('Template', 1, $template);
        $t->update('TemplateAsync', 1, $template);  

        //La méthode delete(). Vous avez le choix entre Template ou TemplateAsync ou Hardbounces ou HardbouncesAsync
        $t->delete('Template', ['id'=>1]);
        $t->delete('TemplateAsync', ['id'=>1]);
        $t->delete('Hardbounces', ['Hardbounces'=>$Hardbounces]) //Hardbounces optionnelle
        $t->delete('HardbouncesAsync', ['Hardbounces'=>$Hardbounces])

        //La méthode send(). Vous avez le choix entre Template ou TemplateAsync ou TestTemplate ou TestTemplateAsync ou TransacEmail ou TrasacEmailAsync
        $t->send('Template', $fromto, 1);
        $t->send('TemplateAsync', $fromto, 1);
        $t->send('TestTemplate', $fromto, 1);
        $t->send('TestTemplateAsync', $fromto, 1);
        $t->send('TransacEmail', $fromto);
        $t->send('TransacEmailAsync', $fromto);

        //La méthode getTemplate(). Vous avez le choix entre Template ou TemplateAsync ou Templates ou TemplatesAsync
        $t->getTemplate('Template',1); // Afficher le template dont l'id est 1
        $t->getTemplate('TemplateAsync', 1); // Afficher le templateAsync dont l'id est 1
        $t->getTemplate('Templates'); // Affiche tout les templates
        $t->getTemplate('TemplatesAsync'); // Affiche tout les templatesAsync

        //La méthode
        $t->getEmailReport('Report', $limit, $offset, $startDate, $endDate, $days, $email, $event, $tags, $messageId, $templateId);
        $t->getEmailReport('ReportAsync', $limit, $offset, $startDate, $endDate, $days, $email, $event, $tags, $messageId, $templateId);

        //La méthode
        $t->getReport('Report', $limit, $offset, $startDate, $endDate, $days, $tag);
        $t->getReport('ReportAsync', $limit, $offset, $startDate, $endDate, $days, $tag);

        //
        $t->getAggragated('Report', $startDate, $endDate, $days, $tag);
        $t->getAggragated('ReportAsync', $startDate, $endDate, $days, $tag);
    }
}
```
